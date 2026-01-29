<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ReviewController;
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

// Reservation endpoints
Route::post('/reservations', [ReservationController::class, 'store']);
Route::post('/reservations/check-availability', [ReservationController::class, 'checkAvailability']);

// Protected Admin Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/user', function (Illuminate\Http\Request $request) {
        return $request->user();
    });
    
    // CRUD Menu
    Route::post('/menu', [MenuController::class, 'store']);
    Route::post('/menu/{id}', [MenuController::class, 'update']); // Use POST with _method=PUT for file upload support
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);
});
