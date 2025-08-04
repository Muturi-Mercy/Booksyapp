<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('book')->get();
        $recommendations = Book::latest()->take(6)->get();

        $total = $cartItems->sum(function ($item) {
        return $item->book->price * $item->quantity;
        });
        return view('pages.cartitem', compact('cartItems','recommendations', 'total'));
    }

    public function add(Request $request, Book $book)
    {
        $user = Auth::user();

        $cartItem = CartItem::where('user_id', $user->id)
                            ->where('book_id', $book->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Book removed from cart.');
    }

    public function orderAll()
{
    $user = Auth::user();
    $cartItems = $user->cartItems()->with('book')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {
        foreach ($cartItems as $item) {
            $book = $item->book;

            if ($book->stock_quantity < $item->quantity) {
                DB::rollBack();
                return redirect()->back()->with('error', "Not enough stock for '{$book->title}'.");
            }

            // Deduct stock
            $book->stock_quantity -= $item->quantity;
            $book->save();

            // Create Order
            Order::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'quantity' => $item->quantity,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            // Remove from cart
            $item->delete();
        }

        DB::commit();
        return redirect()->route('orders.user')->with('success', 'All items have been ordered successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong while placing orders.');
    }
}




}
