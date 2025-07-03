<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\BookController;

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

    //routes accessible by all authenticated users user &admin
    Route::get('/books',[BookController::class,'index']);
    Route::get('/books/{id}',[BookController::class,'show']);

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
});