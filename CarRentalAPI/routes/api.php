<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('cars', CarController::class);
Route::apiResource('rentals', RentalController::class);
Route::post('register', [AuthController::class, 'register']);