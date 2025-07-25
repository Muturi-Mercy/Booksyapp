<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login'); // Blade form
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate first
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login with session-based web guard
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'You are now logged in!');

        }

        // Back with error
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
