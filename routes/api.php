<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiVacanciesController;
use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiWorkersController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiProductsController;



Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/test-auth', function () {
        return response()->json([
            'user' => auth()->user(),
            'is_authenticated' => auth()->check(),
            'is_admin' => auth()->user()->role === 'admin'
        ]);
    });

    Route::controller(ApiVacanciesController::class)->group(function () {
        Route::get('/vacancies', 'index');
        Route::get('/vacancies/{id}', 'show');
    });

    Route::controller(ApiCartController::class)->group(function () {
        Route::get('/cart', 'index');
        Route::delete('/cart/{cart_id}', 'destroy');
        Route::post('/orders', 'store');
        Route::post('/cart/add/{product_id}', 'add');
    });

    Route::controller(ApiProductsController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/filter', 'filter');
        Route::get('/products/filters', 'getFilters');
    });

});



Route::middleware(['auth:sanctum', 'admin'])->group(function() {
    Route::controller(ApiVacanciesController::class)->group(function () {
        Route::post('/vacancies', 'store');
        Route::put('/vacancies/{id}', 'update');
        Route::delete('/vacancies/{id}', 'destroy');
    });

     Route::controller(ApiWorkersController::class)->group(function () {
        Route::get('/workers', 'index');
        Route::get('/workers/{id}', 'show');
        Route::post('/workers', 'store');
        Route::put('/workers/{id}', 'update');
        Route::delete('/workers/{id}', 'destroy');
    });

    Route::controller(ApiProductsController::class)->group(function () {
        Route::get('/product/{id}', 'show');
        Route::post('/products', 'store');
        Route::put('/products/{id}', 'update');
        Route::delete('/products/{product_id}', 'destroy');
    });
});

