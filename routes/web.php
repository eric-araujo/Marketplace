<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'sigle'])->name('product.sigle');

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::post('photos/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');
    });
});

Auth::routes();