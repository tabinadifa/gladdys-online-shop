<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAnnounceController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;       

Route::get('/home', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth', 'admin');

Route::get('/', [ProductController::class, 'index'])->name('index');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::resource('/admin/dashboard/products', AdminProductController::class);

Route::resource('/admin/dashboard/about', AdminAboutController::class);

Route::resource('/admin/dashboard/category', AdminCategoryController::class);

Route::resource('/admin/dashboard/user', AdminUserController::class);

Route::resource('/admin/dashboard/announce', AdminAnnounceController::class);

Route::resource('/admin/dashboard/orders', AdminOrderController::class);

Route::resource('/admin/dashboard/payment', AdminPayController::class);

Route::resource('/admin/dashboard/contact', AdminContactController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'cekOngkir'])->name('checkout.cekOngkir');
    Route::get('/checkout/result', [CheckoutController::class, 'result'])->name('checkout.result');
    Route::get('/checkout/form', [CheckoutController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
require __DIR__.'/auth.php';
