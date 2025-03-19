<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\PasswordResetController;

use Illuminate\Support\Facades\Route;

// Nhóm route cho chức năng đăng nhập và đăng ký (không áp dụng middleware auth)
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Route đăng ký
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Route quên mật khẩu
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetEmail'])->name('password.email');

    Route::get('/verify-otp', [PasswordResetController::class, 'showVerifyOtpForm'])->name('password.verify');
    Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp']);
    Route::post('/resend-otp', [PasswordResetController::class, 'resendOtp'])->name('password.resend');

    Route::get('/reset-password', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

});

// Nhóm route admin (bảo vệ bởi middleware auth)
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // Route trang chính (dashboard)
    Route::get('/dashboard', action: [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');



    // Các route resource
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('orders', OrderController::class)->except(['create', 'store']);
    

    // Route báo cáo
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Route đăng xuất
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');


});
