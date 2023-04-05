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
