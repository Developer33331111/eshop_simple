<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductsController;

Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {

  Route::get('products',[ProductsController::class, 'index'])->middleware(['role:Admin|User']);

  Route::post('products',[ProductsController::class, 'store'])->middleware(['auth:sanctum', 'role:Admin']);

  Route::post('products/{product_id}/update',[ProductsController::class, 'update'])->middleware(['auth:sanctum', 'role:Admin']);

  Route::delete('products/{product_id}',[ProductsController::class, 'destroy'])->middleware(['auth:sanctum', 'role:Admin']);

});
