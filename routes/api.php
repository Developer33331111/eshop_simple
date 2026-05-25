<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductsController;

Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum', 'role:Admin|User'])->group(function() {

  Route::get('products',[ProductsController::class, 'index']);

});
