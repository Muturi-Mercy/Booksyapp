<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {

    //user registration
    public function register(Request $request)
    {
        $request->validate([
            'name' =>'required|string',
            'email' =>'required|email|unique:users',
            'password' =>'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
            'role'=>'user'
        
        ]);
        return response()->json(['message'=>'User registered successfully'],201); //Returns a success response with HTTP status 201 Created.


    }

    //user login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first(); //Will search for a user with that email.
        
        if (!$user || !Hash::check($request->password,$user->password)) //"If no user is found OR the password is incorrect, then The error message is returned under the email field, even if the password was wrong 
        {
            throw ValidationException::withMessages(['email'=>['The provided credentials are incorrect.'],]);
        }

        $token = $user->createToken('api_token')->plainTextToken;       //gives personal access token

        return response()->json([
            'token'=> $token,
            'user' => $user
        ]);
    }

}


















