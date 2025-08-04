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
}
