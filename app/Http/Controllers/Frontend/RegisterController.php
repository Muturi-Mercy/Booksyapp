<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
Use App\Models\User;


class RegisterController extends Controller
{
    //show reg form
    public function showRegistrationForm(){
        return view('auth.register'); //blade form
    }

    //handle registration
     public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create new user (default to 'user' role)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // same as API logic
        ]);

        // Auto-login after registration
        Auth::login($user);

        return redirect('dashboard')->with('success', 'Registration successful!');

    }
}
