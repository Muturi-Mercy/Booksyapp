<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BookCatalogController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Frontend\ShopController;

// Route::get('/', function () {
//     return view('welcome');
// });

//  Route::get('/', fn () => view('pages.home'))->name('home');
 Route::get('/', [HomeController::class, 'index'])->name('home');


//AUTH
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//BOOKS
Route::get('/books',[BookCatalogController::class,'index'])->name('books.index');
Route::get('/books/{id}',[BookCatalogController::class, 'show'])->name('books.show');

//Dashboard
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//user profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

//orders
Route::middleware('auth')->get('/my-orders', [OrderHistoryController::class, 'index'])->name('orders.user');

Route::middleware('auth')->group(function () {
    Route::post('/order-from-cart', [OrderHistoryController::class, 'storeFromCart'])->name('orders.cart');
    Route::post('/orders/store', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/cancel', [OrderHistoryController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{id}/reorder', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');
});

//checkout
Route::middleware('auth')->get('/checkout/{order}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::middleware('auth')->post('/checkout/{order}', [CheckoutController::class, 'process'])->name('checkout.process');

//thankyou
Route::middleware('auth')->get('/thank-you', function () {
    return view('pages.thankyou');
})->name('thankyou');

//cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/order-all', [CartController::class, 'orderAll'])->name('cart.orderAll');
    // Route::get('/orders/user', [CartController::class, 'showUserOrders'])->name('orders.user');

});

//shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/genre/{genre}', [ShopController::class, 'showByGenre'])->name('shop.genre');
Route::post('/cart/add/{book}', [ShopController::class, 'addToCart'])->name('cart.add');

