<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api\admin', 'prefix' => 'admin.'], function () {

    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
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
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact Toyrejoy@gmail.com'], 404);
});