<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\PromotionController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Route::get('login', [AuthController::class, 'getLogin'])->name('admin.login');
// Route::post('login', [AuthController::class, 'postLogin'])->name('admin.login.handle');
// Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');

Route::group(['middleware' => ['check_login_admin'] , 'as' => 'admin.'], function () {
	// echo 'helloooo admin';exit;

    Route::get('login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('login.handle');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
	
	// Admin Dashboard
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard');	

    // route for module Category
	Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // route for module Product
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/list', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // // route for module User
	// Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    //     Route::get('/list', [UserController::class, 'index'])->name('index');
    //     Route::get('/create', [CategoryController::class, 'create'])->name('create');
    //     Route::post('/store', [CategoryController::class, 'store'])->name('store');
    //     Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
    //     Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    //     Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
    //     Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    // });

    // route for module Order
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/list', [OrderController::class, 'index'])->name('index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('destroy');
    });
    
        // route for module Promotion
        Route::group(['prefix' => 'promotion', 'as' => 'promotion.'], function () {
            Route::get('/list', [PromotionController::class, 'index'])->name('index');
            Route::get('/show/{id}', [PromotionController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [PromotionController::class, 'edit'])->name('edit');
            Route::put('//update/{id}', [PromotionController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [PromotionController::class, 'destroy'])->name('destroy');
        });
});
