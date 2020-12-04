<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StoreController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    Route::prefix('stores')->group(function() {
        Route::get('/', [StoreController::class, 'index']);
        Route::get('/create', [StoreController::class, 'create']);
        Route::post('/store', [StoreController::class, 'store']);
        Route::get('/{store}/edit', [StoreController::class, 'edit']);
        Route::post('/update/{store}', [StoreController::class, 'update']);
    });
});