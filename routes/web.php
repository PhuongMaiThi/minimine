<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [homeController::class, 'index'])->name('home');

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::post('cart/{id}', [CartController::class, 'addCart'])->name('add')->middleware(['auth']);
    Route::get('/', [CartController::class, 'getCartInfo'])->name('cart-info')->middleware('check_order_step_by_step'); 
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('checkout-complete', [CartController::class, 'checkoutComplete'])->name('checkout-complete')->middleware(['auth']);
    Route::delete('/delete/{id}', [CartController::class, 'destroy'])->name('destroy')->middleware(['auth']);

});



