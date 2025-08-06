<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['book', 'user'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    // public function markAsPaid($id)
    // {
    //     $order = Order::findOrFail($id);
    //     $order->payment_status = 'paid';
    //     $order->save();
    //     return back()->with('success', 'Marked as paid.');
    // }

    public function markAsComplete($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();
        return back()->with('success', 'Marked as complete.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();
        return back()->with('success', 'Order cancelled.');
    }
}


