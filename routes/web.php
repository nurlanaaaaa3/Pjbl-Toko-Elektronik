<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

// USER LOGIN
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');

// REGISTER
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.post');

// USER LOGOUT
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// ADMIN LOGIN
Route::get('/admin/login', [UserAuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [UserAuthController::class, 'adminLogin'])->name('admin.login.post');

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

// SHOP (public)
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

// USER (auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/orders', [OrderController::class, 'history'])->name('order.history');
});

// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // PROFILE ADMIN
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
        Route::patch('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

        // ADMIN LOGOUT
        Route::post('/logout', [UserAuthController::class, 'adminLogout'])->name('logout');
    });