<?php

use App\Http\Controllers\customer\AuthController;
use App\Http\Controllers\customer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api\customer', 'prefix' => 'api/customer'], function () {

    // authentication
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    // authenticated
    Route::middleware('auth:customer')->group(function () {
        Route::get('/profile/{id}', [ProfileController::class, 'view']);
        Route::put('/profile/{id}', [ProfileController::class, 'update']);
        Route::delete('/profile/{id}', [ProfileController::class, 'delete']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
