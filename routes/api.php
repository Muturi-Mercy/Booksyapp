<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;

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

    //routes for authenticated user to  update their own profile 
    Route::put('/profile',[CustomerController::class,'update']);

    //routes FOR BOOK accessible by all authenticated users user &admin
    Route::get('/books',[BookController::class,'index']);
    Route::get('/books/{id}',[BookController::class,'show'])->where('id', '[0-9]+');

    //routes for orders for all authenticated user
    Route::get('/orders',[OrderController::class,'index']); //Admins$ user will see all orders
    Route::post('/orders',[OrderController::class,'store']); //user places a new order for a book

    //routes for user to log out
    Route::post('/logout', [AuthController::class, 'logout']);

    
    //ADMIN ONLY ROUTES
    Route::middleware(IsAdmin::class)->group(function(){  //IsAdmin checks the user's role.
        
       //Admin dashboard summary mgmt
        Route::get('/admin/dashboard',[DashboardController::class,'summary']);

        //Admin low stock mgmnt
        Route::get('/books/low-stock',[BookController::class,'lowStock']);//see which books are running low on stock

        //Admin customer management
        Route::get('/customers',[CustomerController::class,'index']);
        Route::get('/customers/{id}',[CustomerController::class,'show']);

        //Admin book mgmnt
        Route::post('/books',[BookController::class,'store']);
        Route::put('/books/{id}',[BookController::class,'update']);
        Route::delete('/books/{id}',[BookController::class,'destroy']);

        //Admin order management
        Route::put('/orders/{id}/status',[OrderController::class,'updateStatus']); //Allow admin to update the order status

        //Admin payment mgmt
        Route::put('/orders/{id}/pay',[PaymentController::class,'markAsPaid']);
    });

    
});