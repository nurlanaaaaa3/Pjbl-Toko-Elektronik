<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Auth\PasswordController;

// Root redirect ke user login
Route::get('/', function () {
    return redirect()->route('user.login');
});

// ===== USER AUTH =====
Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.post');
Route::get('/user/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [UserAuthController::class, 'register'])->name('user.register.post');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// ===== ADMIN AUTH =====
Route::get('/admin/login', [UserAuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [UserAuthController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/admin/logout', [UserAuthController::class, 'adminLogout'])->name('admin.logout');

// ===== DASHBOARD =====
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

// ===== PROFILE (admin only) =====
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update'); // ✅
});

// ===== SHOP (public) =====
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

// ===== USER ROUTES (auth) =====
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

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });