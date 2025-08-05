<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::user()->id) {
            abort(403);
        }

        return view('pages.checkout', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);
        $user = Auth::user();
        $user->update([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        $order->update([
            'payment_status' => 'paid',
        ]);

        return redirect()->route('thankyou');

    } 
   public function showAll(Request $request)
{
    $orderIds = $request->query('orders', []);
    if (!is_array($orderIds)) {
        $orderIds = explode(',', $orderIds);
    }

    $orders = Order::whereIn('id', $orderIds)
                   ->where('user_id', Auth::id())
                   ->where('payment_status', 'unpaid')
                   ->where('status', 'pending')
                   ->with('book')
                   ->get();

    if ($orders->isEmpty()) {
        return redirect()->route('orders.user')->with('error', 'No valid orders to checkout.');
    }

    $orderIds = $orders->pluck('id')->toArray();

    return view('pages.checkout_all', compact('orders', 'orderIds'));
} 

public function processAll(Request $request)
{
    $orderIds = explode(',', $request->input('order_ids'));

    $request->validate([
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'order_ids' => 'required|string',
    ]);

    $orders = Order::whereIn('id', $orderIds)
                   ->where('user_id', Auth::id())
                   ->where('payment_status', 'unpaid')
                   ->where('status', 'pending')
                   ->get();

    if ($orders->isEmpty()) {
        return redirect()->route('orders.user')->with('error', 'No valid orders to process.');
    }

    $user = Auth::user();
    $user->update([
        'address' => $request->address,
        'phone' => $request->phone,
    ]);

    foreach ($orders as $order) {
        $order->update([
            'payment_status' => 'paid',
        ]);
    }

    return redirect()->route('thankyou')->with('success', 'All orders processed successfully.');
}
}
