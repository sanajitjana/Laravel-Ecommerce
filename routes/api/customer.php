<?php

use App\Http\Controllers\customer\AuthController;
use App\Http\Controllers\customer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api\customer', 'prefix' => 'api/customer'], function () {

    // authentication
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // authenticated
    Route::middleware('auth:api')->group(function () {
        Route::get('/profile/{id}', [ProfileController::class, 'view']);
        Route::put('/profile/{id}', [ProfileController::class, 'update']);
        Route::delete('/profile/{id}', [ProfileController::class, 'delete']);
    });
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact Toyrejoy@gmail.com'], 404);
});