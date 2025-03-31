<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController as UserProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ==================== PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product routes
Route::controller(UserProductController::class)->group(function() {
    Route::get('/products', 'all_product')->name('products.all');
    Route::get('/products/new', 'new_product')->name('products.new');
    Route::get('/products/category/{id}', 'show')->name('category.show');
    Route::get('/products/{id}', 'product_detail')->name('products.show');
});

// Authentication routes
Route::prefix('auth')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Registration
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Password reset
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetEmail'])->name('password.email');
    Route::get('/verify-otp', [PasswordResetController::class, 'showVerifyOtpForm'])->name('password.verify');
    Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp']);
    Route::post('/resend-otp', [PasswordResetController::class, 'resendOtp'])->name('password.resend');
    Route::get('/reset-password', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
    
    // Logout (common for all users)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ==================== AUTHENTICATED USER ROUTES ====================
Route::middleware('auth')->group(function() {
    // Cart routes
    Route::prefix('user/cart')->group(function() {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/', [CartController::class, 'store'])->name('cart.store');
        Route::put('/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
        
        // Checkout
        Route::get('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    });
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->middleware(['auth', 'can:access-admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User management
    Route::resource('users', UserController::class);
    
    // Category management
    Route::resource('categories', CategoryController::class);
    
    // Product management
    Route::resource('products', AdminProductController::class);
    
    // Brand management
    Route::resource('brands', BrandController::class);
    
    // Order management
    Route::controller(OrderController::class)->prefix('orders')->group(function() {
        Route::get('/', 'index')->name('admin.orders.index');
        Route::get('/{order}', 'show')->name('admin.orders.show');
        Route::get('/{order}/edit', 'edit')->name('admin.orders.edit');
        Route::put('/{order}', 'update')->name('admin.orders.update');
        Route::delete('/{order}', 'destroy')->name('admin.orders.destroy');
    });
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});