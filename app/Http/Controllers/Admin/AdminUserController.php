<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Book;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get(); // exclude admins
        return view('admin.users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

        public function show($id)
    {
        $user = User::with('orders.book')->findOrFail($id); 
        return view('admin.user_profile', compact('user'));
    }
}
