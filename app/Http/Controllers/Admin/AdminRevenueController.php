<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminRevenueController extends Controller
{
     
public function index()
{
    // Total revenue and orders
    $totalRevenue = DB::table('orders')
        ->join('books', 'orders.book_id', '=', 'books.id')
        ->where('orders.payment_status', 'paid')
        ->sum(DB::raw('orders.quantity * books.price'));

    $totalOrders = DB::table('orders')
        ->where('payment_status', 'paid')
        ->count();

    // Monthly revenue
    $monthlyRevenue = DB::table('orders')
        ->join('books', 'orders.book_id', '=', 'books.id')
        ->select(DB::raw("TO_CHAR(orders.created_at, 'YYYY-MM') as month"), DB::raw('SUM(orders.quantity * books.price) as revenue'))
        ->where('orders.payment_status', 'paid')
        ->groupBy(DB::raw("TO_CHAR(orders.created_at, 'YYYY-MM')"))
        ->orderBy('month')
        ->get();

    return view('admin.revenue', compact('totalRevenue', 'totalOrders', 'monthlyRevenue'));
}
}
