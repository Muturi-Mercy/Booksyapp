<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;

//public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//protected routes require token
Route::middleware('auth:sanctum')->group(function()  //verifies the user is authenticated
{
    Route::get('/user', function (Request $request)
     {
    return $request->user();
    });

    //routes FOR BOOK accessible by all authenticated users user &admin
    Route::get('/books',[BookController::class,'index']);
    Route::get('/books/{id}',[BookController::class,'show']);

    //routes for orders for all authenticated user
    Route::get('/orders',[OrderController::class,'index']); //Admins$ user will see all orders
    Route::post('/orders',[OrderController::class,'store']); //user places a new order for a book

    //admin only route
    Route::middleware(IsAdmin::class)->group(function(){  //IsAdmin checks the user's role.
        Route::get('/admin/dashboard',function(){
            return response()->json([
                'message'=>'Welcome,Admin!'
            ]);
        });

    //Admin book mgmnt
    Route::post('/books',[BookController::class,'store']);
    Route::put('/books/{id}',[BookController::class,'update']);
    Route::delete('/books/{id}',[BookController::class,'destroy']);
    });

    //Admin order management
    Route::put('/orders/{id}/status',[OrderController::class,'updateStatus']); //Allow admin to update the order status
});