<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    
    // Car routes
    Route::apiResource('cars', CarController::class);
    
    // Rental routes
    Route::apiResource('rentals', RentalController::class);
    Route::post('/rentals/{rentalId}/payment', [PaymentController::class, 'createPaymentIntent']);
    
    // Payment routes
    // Route::prefix('payments')->group(function () {
    //     Route::post('/confirm', [PaymentController::class, 'confirmPayment']);
    //     Route::get('/status/{paymentIntentId}', [PaymentController::class, 'getPaymentStatus']);
    // });
    // Route::post('payments/create/{rentalId}', [PaymentController::class, 'createPayment']);
});


Route::get('api/documentation', function () {
    return view('swagger::index');
});