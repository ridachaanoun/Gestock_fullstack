<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Existing API resource routes for other models
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('order-items', OrderItemController::class);
    Route::apiResource('inventories', InventoryController::class);
    
    // User management routes (Admin only)
    Route::middleware(['auth:sanctum', 'can:viewAny,App\Models\User'])->group(function () {
        Route::get('/users', [UserController::class, 'index']); // List users
        Route::post('/users', [UserController::class, 'store']); // Create user
        Route::get('/users/{user}', [UserController::class, 'show']); // Show user
        Route::put('/users/{user}', [UserController::class, 'update']); // Update user
        Route::delete('/users/{user}', [UserController::class, 'destroy']); // Delete user
    });
    

    // Route to fetch the authenticated user's data
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
