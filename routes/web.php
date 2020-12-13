<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\Admin\OrdersController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'sigle'])->name('product.sigle');
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.sigle');
Route::get('/store/{slug}', [App\Http\Controllers\StoreController::class, 'index'])->name('store.sigle');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::get('remove/{slug}', [CartController::class, 'remove'])->name('remove');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/proccess', [CheckoutController::class, 'proccess'])->name('proccess');
    Route::get('/thanks', [CheckoutController::class, 'thanks'])->name('thanks');
});

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::post('photos/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');

        Route::get('orders/my', [OrdersController::class, 'index'])->name('orders.my');
    });
});

Auth::routes();