<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

Route::post('/create-order', [PaymentController::class, 'createOrder'])->name('payment.create');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

Route::get('/checkout/receipt/{order}', [PaymentController::class, 'showReceipt'])->name('checkout.receipt');

Route::post('/products/{product}/update-image', [ProductController::class, 'updateImage'])->name('products.update-image');

Route::resource('products', ProductController::class);

// Payment routes
Route::post('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// Cart routes
Route::post('/cart/process-checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
Route::get('/cart/receipt/{order}', [CartController::class, 'receipt'])->name('cart.receipt');
