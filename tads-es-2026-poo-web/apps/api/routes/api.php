<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;



Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('orders', OrderController::class);
Route::post('/upload', [UploadController::class, 'upload']);
