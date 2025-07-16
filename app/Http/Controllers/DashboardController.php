<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function summary(){
       $totalUsers = User::where('role','user')->count(); //total customers
       $totalBooks = Book::count(); //total books
       $totalOrders = Order::count(); //total orders
       $pendingOrders = Order::where('status','pending')->count(); //total pending orders
       $completedOrders = Order::where('status','completed')->count(); //total completed orders

       $totalRevenue = Order::where('status','completed')
            ->join('books','orders.book_id','=','books.id') //Joins the orders table with the books table so we can access book price.
            ->select(DB::raw('SUM(orders.quantity * books.price) as revenue'))
            ->value('revenue')?? 0; //If there’s no result, it defaults to 0 using ?? 0.

        return response()->json([
            'total_users' => $totalUsers,
            'total_books' => $totalBooks,
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'completed_orders' => $completedOrders,
            'total_revenue' => $totalRevenue
        ]);
      }
}
