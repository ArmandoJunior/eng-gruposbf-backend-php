<?php

use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
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

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{id}', 'show');
});

Route::controller(PriceController::class)->group(function () {
    Route::get('/prices', 'index');
    Route::get('/prices/renew', 'renew');
    Route::post('/prices', 'store');
    Route::get('/prices/update', 'update');
});
