<?php

use App\Http\Controllers\admin\LoginController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

/*authenticated*/
Route::group(['middleware' => ['admin']], function () {

    //dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
    });

    //reports routes
    Route::group(['prefix' => 'reports'], function () {
    });
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact Toyrejoy@gmail.com'], 404);
});