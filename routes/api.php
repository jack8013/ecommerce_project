<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminOrderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::apiResource('products',ProductController::class);

Route::apiResource('categories', AdminController::class);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/orders', [AdminOrderController::class, 'index']);
Route::get('/orders/{id}', [AdminOrderController::class, 'show']);
Route::post('/orders', [AdminOrderController::class, 'store']);
Route::put('/orders/{id}', [AdminOrderController::class, 'update']);
//Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy']);

// Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart', [CartController::class, 'show']);
Route::post('/cart/{id}', [CartController::class, 'store']);
// Route::put('/cart/{id}', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
