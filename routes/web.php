<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::prefix('stores')->name('stores.')->group(function() {
        Route::get('/', [StoreController::class, 'index'])->name('index');
        Route::get('/create', [StoreController::class, 'create'])->name('create');;
        Route::post('/store', [StoreController::class, 'store'])->name('store');;
        Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');;
        Route::post('/update/{store}', [StoreController::class, 'update'])->name('update');;
        Route::get('/destroy/{store}', [StoreController::class, 'destroy'])->name('destroy');;
    });
});