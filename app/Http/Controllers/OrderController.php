<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $orders = $request->user()->role === 'admin'?
             Order::with('user', 'book')->get(): //Gets all orders from the database, along with related user and book data.
             $request->user()->orders()->with('book')->get();//Gets only the orders placed by this user, with related book info.

        $transformed = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'user_name' => $order->user->name ?? 'N/A',
                'book_id' => $order->book_id,
                'book_title' => $order->book->title ?? 'N/A',
                'quantity' => $order->quantity,
                'status' => $order->status,
                'created_at' => $order->created_at->toDateTimeString(),
            ];
        });

        return response()->json($transformed);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $data =$request->validate([
            'book_id'=>'required|exists:books,id',
            'quantity'=>'required|integer|min:1',
        ]);

        $book =Book::find($data['book_id']);
        //checks stock
        if ($book->stock_quantity < $data['quantity']){
            return response()->json(['message'=>'Not enough stock'],400);
        }

        //reduces stock
        $book->stock_quantity -= $data['quantity']; //take the book's current stock and subtract the quantity the user ordered, and then save that new value back to stock_quantity
        $book->save();

        //creates the order
        $order =Order::create([
            'user_id'=>$request->user()->id,
            'book_id'=>$data['book_id'],
            'quantity'=>$data['quantity'],
            'status'=>'pending'
        ]);

        return response()->json(
            Order::with('book')->find($order->id),201); 

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request,$id)
    {
        //finds the new order
        $order = Order::find($id);
           if (!$order) return response()->json(['message' => 'Order not found'], 404);
        //validate new status
        $request->validate([
        'status' => 'required|in:pending,completed'
        ]);
        //update the order status
         $order->status = $request->status;
         $order->save();

        return response()->json(['message' => 'Order status updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
