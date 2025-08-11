<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookAdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRevenueController;
// Route::get('/', function () {
//     return view('welcome');
// });

//  Route::get('/', fn () => view('pages.home'))->name('home');
 Route::get('/', [HomeController::class, 'index'])->name('home');


//AUTH

Route::get('/login', function () {
    if (Auth::check()) {
        return Auth::user()->is_admin 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//BOOKS
Route::get('/books',[BookCatalogController::class,'index'])->name('books.index');
Route::get('/books/{id}',[BookCatalogController::class, 'show'])->name('books.show');

// -----------Admin-------------
Route::middleware(['auth', 'is_admin'])->prefix('admin/books')->group(function () {
    Route::get('/', [BookAdminController::class, 'index'])->name('admin.books.index');
    Route::get('/create', [BookAdminController::class, 'create'])->name('admin.books.create');
    Route::post('/store', [BookAdminController::class, 'store'])->name('admin.books.store');
    Route::get('/{id}/edit', [BookAdminController::class, 'edit'])->name('admin.books.edit');
    Route::post('/{id}/update', [BookAdminController::class, 'update'])->name('admin.books.update');
    Route::post('/{id}/delete', [BookAdminController::class, 'destroy'])->name('admin.books.delete');
});

//Dashboard
Route::middleware('auth')->get('/homedashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
})->name('homedashboard');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'is_admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

//user profile
Route::get('/profile', function () {
    if (Auth::check()) {
        return redirect()->route('profile.edit'); 
    }
    return redirect()->route('login');
})->name('myprofile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

//orders
Route::get('/my-orders', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.orders.index');
    } else {
        return redirect()->route('orders.user');
    }
})->name('orders');

Route::middleware('auth')->get('/my-orders', [OrderHistoryController::class, 'index'])->name('orders.user');

Route::middleware('auth')->group(function () {
    Route::post('/order-from-cart', [OrderHistoryController::class, 'storeFromCart'])->name('orders.cart');
    Route::post('/orders/store', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/cancel', [OrderHistoryController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{id}/reorder', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');
    Route::post('/orders/place-all', [OrderHistoryController::class, 'placeAll'])->name('orders.placeAll');
});

// -----------Admin-------------

Route::middleware(['auth', 'is_admin'])->prefix('admin/orders')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    // Route::post('/{id}/mark-paid', [AdminOrderController::class, 'markAsPaid'])->name('admin.orders.markPaid');
    Route::post('/{id}/mark-complete', [AdminOrderController::class, 'markAsComplete'])->name('admin.orders.markComplete');
    Route::post('/{id}/cancel', [AdminOrderController::class, 'cancel'])->name('admin.orders.cancel');
});

//checkout
Route::middleware('auth')->get('/checkout/{order}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::middleware('auth')->post('/checkout/{order}', [CheckoutController::class, 'process'])->name('checkout.process');
Route::middleware('auth')->get('/checkout-all', [CheckoutController::class, 'showAll'])->name('checkout.showAll');
Route::middleware('auth')->post('/checkout-all', [CheckoutController::class, 'processAll'])->name('checkout.processAll');

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

//low stock
Route::get('/admin/low-stock', function () {
    $books = \App\Models\Book::where('stock_quantity', '<=', 5)->get();
    return view('admin.low_stock', compact('books'));
})->middleware(['auth', 'is_admin'])->name('admin.lowstock');

//usersmgmt
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');

});

//revenue
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/revenue', [AdminRevenueController::class, 'index'])->name('admin.revenue.index');
});