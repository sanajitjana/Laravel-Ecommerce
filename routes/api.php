<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//public api
Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


// api for only login user
Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['namespace' => 'NGO'], function () {
        Route::get('/ngos', [NgoController::class, 'index']);
        Route::post('/ngo', [NgoController::class, 'store']);
        Route::get('/ngos/{id}', [NgoController::class, 'show']);
        Route::put('/ngos/{id}', [NgoController::class, 'update']);
        Route::delete('/ngos/{id}', [NgoController::class, 'destroy']);
    });
});
