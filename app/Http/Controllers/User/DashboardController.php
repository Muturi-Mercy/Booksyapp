<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
      public function index()
    {
        $user = Auth::user();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'completed')->count();
        $latestBooks = Book::latest()->take(4)->get();
        $cartItems = Auth::user()->cartItems()->with('book')->get();

        return view('pages.dashboard', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders', 'latestBooks','cartItems'));
    }
}
