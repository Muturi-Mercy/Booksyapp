<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('book') // assumes order has book_id relation
                       ->where('user_id', Auth::id())
                       ->latest()
                       ->get();
        $recommendations = Book::latest()->take(6)->get();

        return view('pages.order', compact('orders', 'recommendations'));
        
    } 


    public function cancel($id)
{
    $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

    if ($order->status === 'pending') {
        $order->delete();

        return back()->with('success', 'Order cancelled and deleted successfully.');
    }

    return back()->with('error', 'Only pending orders can be cancelled.');
}


    public function reorder($id)
{
    $original = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
    $book = Book::findOrFail($original->book_id);

        if ($book->stock_quantity < $original->quantity) {
            return back()->with('error', 'Not enough stock for ' . $book->title);
        }

        $book->stock_quantity -= $original->quantity;
        $book->save();
    // Clone the order with status = pending and payment_status = unpaid
    $newOrder = Order::create([
        'user_id' => Auth::id(),
        'book_id' => $original->book_id,
        'quantity' => $original->quantity,
        'status' => 'pending',
        'payment_status' => 'unpaid',
    ]);

    return back()->with('success', 'Order placed again successfully!');
}
    public function storeFromCart(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $book = Book::findOrFail($request->book_id);

    if ($book->stock_quantity < $request->quantity) {
        return back()->with('error', 'Not enough stock for ' . $book->title);
    }

    // Create order and reduce stock
    $book->stock_quantity -= $request->quantity;
    $book->save();

    Order::create([
        'user_id' => Auth::id(),
        'book_id' => $book->id,
        'quantity' => $request->quantity,
        'status' => 'pending',
        'payment_status' => 'unpaid',
    ]);

    return redirect()->route('orders.user')->with('success', 'Order placed successfully!');
}
public function showUserOrders()
{
    $user = Auth::user();

    $cartItems = $user->orders()->with('book')->latest()->get(); // 'orders' relation should exist on User model

    $recommendations = Book::latest()->take(6)->get();

    return view('pages.order', compact('orders', 'recommendations'));

}
public function placeAll(Request $request)
{
    $orders = Order::where('user_id', Auth::id())
                   ->where('payment_status', 'unpaid')
                   ->where('status', 'pending')
                   ->get();

    if ($orders->isEmpty()) {
        return back()->with('error', 'No unpaid pending orders to place.');
    }

    $failedOrders = [];
    foreach ($orders as $order) {
        $book = Book::find($order->book_id);
        if (!$book || $book->stock_quantity < $order->quantity) {
            $failedOrders[] = $book ? $book->title : 'Unknown Book';
            continue;
        }

        $book->stock_quantity -= $order->quantity;
        $book->save();

        $order->update([
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);
    }

    if (!empty($failedOrders)) {
        return back()->with('error', 'Could not process orders for: ' . implode(', ', $failedOrders));
    }

    return redirect()->route('checkout.showAll', ['orders' => $orders->pluck('id')->toArray()])
                    ->with('success', 'All orders ready for checkout.');
}

}
