<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'sigle'])->name('product.sigle');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::get('remove/{slug}', [CartController::class, 'remove'])->name('remove');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
});

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::post('photos/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');
    });
});

Auth::routes();