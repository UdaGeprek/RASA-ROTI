<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/produk/{slug}', [PublicController::class, 'show'])->name('public.product.show');
Route::post('/produk/{slug}/pesan', [PublicController::class, 'order'])->name('public.product.order');
Route::get('/pesanan/sukses/{invoice}', [PublicController::class, 'orderSuccess'])->name('public.order.success');
Route::get('/lacak-pesanan', [PublicController::class, 'trackOrder'])->name('public.track');

Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('/sales', [AdminDashboardController::class, 'salesIndex'])->name('sales.index');
    Route::get('/sales/{id}', [AdminDashboardController::class, 'saleDetail'])->name('sales.show');
    Route::patch('/sales/{id}/status', [AdminDashboardController::class, 'updateSaleStatus'])->name('sales.status');
});
