<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\GroomingAppointmentController;
use App\Http\Controllers\Api\CustomServiceController;

// Auth routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Services (public within auth)
    Route::apiResource('services', ServiceController::class);
    
    // Customers
    Route::apiResource('customers', CustomerController::class);
    
    // Pets
    Route::apiResource('pets', PetController::class);
    
    // Grooming Appointments
    Route::apiResource('grooming-appointments', GroomingAppointmentController::class);
    
    // Custom Services
    Route::apiResource('custom-services', CustomServiceController::class);
    Route::patch('/custom-services/{id}/approve', [CustomServiceController::class, 'approve']);
    Route::patch('/custom-services/{id}/reject', [CustomServiceController::class, 'reject']);
});
