<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 Route::apiResource('products', \App\Http\Controllers\ProductController::class);
 Route::apiResource('orders', \App\Http\Controllers\OrderController::class);
 Route::apiResource('services', \App\Http\Controllers\ServiceController::class);
 Route::apiResource('posts', \App\Http\Controllers\PostController::class);
