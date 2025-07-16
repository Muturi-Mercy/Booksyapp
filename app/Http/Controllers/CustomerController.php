<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    //User updates their info
    public function update(Request $request)
    {
        $data =$request->validate([

              'name' => 'sometimes|string',
              'phone' => 'sometimes|string',
              'address' => 'sometimes|string',
        ]);
        $user = $request->user(); //aithenticated user
        $user->update($data);//update only provided fields

         return response()->json(['message' => 'Profile updated', 'user' => $user]);
    }

    //Admin gets all customers
    public function index()
    {
        $customers=User::where('role','user')->get();
        return response()->json($customers);
    }

    //Admin views single customer
    public function show($id){
        $user =User::where('role','user')->find($id);

        if(!$user) return response()->json(['message'=>'Customer not found'],404);
        return response()->json($user);
    }
}
