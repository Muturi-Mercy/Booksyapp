<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BookCatalogController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\RegisterController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn () => view('pages.home'))->name('home');


//AUTH
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//BOOKS
Route::get('/books',[BookCatalogController::class,'index'])->name('books.index');
Route::get('/books/{id}',[BookCatalogController::class, 'show'])->name('books.show');