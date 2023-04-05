<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NgoController;
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


// api for only login user
Route::middleware('auth:api')->group(function () {

    // Ngo's route
    Route::get('/ngos', [NgoController::class, 'index']);
    Route::post('/ngos', [NgoController::class, 'store']);
    Route::get('/ngos/{id}', [NgoController::class, 'show']);
    Route::put('/ngos/{id}', [NgoController::class, 'update']);
    Route::delete('/ngos/{id}', [NgoController::class, 'destroy']);

    // categories route
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    // products route
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    //  donations route
    Route::get('/donations', [DonationDetailsController::class, 'index']);
    Route::post('/donations', [DonationDetailsController::class, 'store']);
    Route::get('/donations/{id}', [DonationDetailsController::class, 'show']);
    Route::put('/donations/{id}', [DonationDetailsController::class, 'update']);
    Route::delete('/donations/{id}', [DonationDetailsController::class, 'destroy']);

    //  carts route
    Route::get('/carts', [CartController::class, 'index']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::get('/carts/{id}', [CartController::class, 'show']);
    Route::put('/carts/{id}', [CartController::class, 'update']);
    Route::delete('/carts/{id}', [CartController::class, 'destroy']);

    //  sellers route
    Route::get('/sellers', [SellerController::class, 'index']);
    Route::post('/sellers', [SellerController::class, 'store']);
    Route::get('/sellers/{id}', [SellerController::class, 'show']);
    Route::put('/sellers/{id}', [SellerController::class, 'update']);
    Route::delete('/sellers/{id}', [SellerController::class, 'destroy']);

    //  orders route
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    //  shipments route
    Route::get('/shipmentdetails', [ShipmentDetailsController::class, 'index']);
    Route::post('/shipmentdetails', [ShipmentDetailsController::class, 'store']);
    Route::get('/shipmentdetails/{id}', [ShipmentDetailsController::class, 'show']);
    Route::put('/shipmentdetails/{id}', [ShipmentDetailsController::class, 'update']);
    Route::delete('/shipmentdetails/{id}', [ShipmentDetailsController::class, 'destroy']);

    //  billings route
    Route::get('/billings', [BillingController::class, 'index']);
    Route::post('/billings', [BillingController::class, 'store']);
    Route::get('/billings/{id}', [BillingController::class, 'show']);
    Route::put('/billings/{id}', [BillingController::class, 'update']);
    Route::delete('/billings/{id}', [BillingController::class, 'destroy']);
});
