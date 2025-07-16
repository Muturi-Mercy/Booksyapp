<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class PaymentController extends Controller
{
     public function markAsPaid($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Order already marked as paid'], 400);
        }

        $order->payment_status = 'paid';
        $order->save();

        return response()->json([
            'message' => 'Order marked as paid',
            'order' => $order
        ]);
    }
}
