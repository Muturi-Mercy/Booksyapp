<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum(DB::raw('quantity * (SELECT price FROM books WHERE books.id = orders.book_id)'));
        $lowStock = Book::where('stock_quantity', '<=', 5)->count();
        $messages = ContactMessage::with('user')->latest()->get();

        return view('admin.dashboard', compact(
            'totalBooks', 'totalCustomers', 'totalOrders',
            'pendingOrders','messages', 'totalRevenue', 'lowStock'
        ));
    }
}


