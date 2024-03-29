<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PayPalController;


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

Route::get('/', function () {
    $products = \App\Models\Product::all();
    return view('welcome', compact('products'));
});

Route::get('/dashboard', function () {
    $products = \App\Models\Product::all();
    return view('dashboard', compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas del proyecto
Route::get('products', [ProductController::class, 'productList'])->name('products.list')->middleware(['auth', 'verified']);
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list')->middleware(['auth', 'verified']);
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store')->middleware(['auth', 'verified']);
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update')->middleware(['auth', 'verified']);
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove')->middleware(['auth', 'verified']);
Route::post('clear', [CartController::class, 'clearCart'])->name('cart.clear')->middleware(['auth', 'verified']);

// Rutas de PayPal
Route::get('payment', [PaypalController::class, 'payment'])->name('payment');
Route::get('cancelPayment', [PaypalController::class, 'cancelPayment'])->name('payment.cancel');
Route::get('successPayment', [PaypalController::class, 'successPayment'])->name('payment.success');

require __DIR__.'/auth.php';
