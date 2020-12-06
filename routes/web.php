<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
    });
});

Auth::routes();