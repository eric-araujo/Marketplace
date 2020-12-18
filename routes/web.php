<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\NotificationController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;

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

    Route::post('/notification', [CheckoutController::class, 'notification'])->name('notification');
});

Route::get('my-orders', [UserOrderController::class, 'index'])->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){
    
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('notifications', [NotificationController::class, 'notification'])->name('notifications.index');
        Route::get('notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');
        Route::get('notifications/read/{notification}', [NotificationController::class, 'read'])->name('notifications.read');

        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::post('photos/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');

        Route::get('orders/my', [OrdersController::class, 'index'])->name('orders.my');
    });
});

Auth::routes();