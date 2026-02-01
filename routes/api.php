<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\GoogleReviewController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Public Menu endpoints
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);

// Review endpoints
Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::get('/google-reviews', [GoogleReviewController::class, 'index']);

// Reservation endpoints
Route::post('/reservations', [ReservationController::class, 'store']);
Route::post('/reservations/check-availability', [ReservationController::class, 'checkAvailability']);

// Orders (Public)
Route::post('/orders', [OrderController::class, 'store']);

// Protected Admin Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/user', function (Illuminate\Http\Request $request) {
        return $request->user();
    });
    
    // CRUD Menu
    Route::post('/menu', [MenuController::class, 'store']);
    Route::post('/menu/{id}', [MenuController::class, 'update']);
    Route::put('/menu/{id}', [MenuController::class, 'update']); // Support _method=PUT (spoofed forms) and direct PUT
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

    // Orders (Admin)
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::patch('/orders/{id}', [OrderController::class, 'update']);
});
