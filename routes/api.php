<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentApiController;
use App\Http\Controllers\Api\AuthApiController;

// ----------------- AUTH -----------------
Route::post('login', [AuthApiController::class, 'login']);
Route::post('register', [AuthApiController::class, 'register']); // optional

// ----------------- PROTECTED ROUTES -----------------
Route::middleware('auth:sanctum')->group(function() {

    // Student routes
    Route::prefix('student')->group(function () {
        Route::get('appointments', [AppointmentApiController::class, 'studentIndex']);
        Route::get('appointments/{appointment}', [AppointmentApiController::class, 'studentShow']);
        Route::post('appointments', [AppointmentApiController::class, 'studentStore']);
        Route::put('appointments/{appointment}/{id}', [AppointmentApiController::class, 'studentUpdate']);
        Route::delete('appointments/{appointment}/{id}', [AppointmentApiController::class, 'studentDestroy']);
    });

    // Counselor routes
    Route::prefix('counselor')->group(function () {
        Route::get('appointments', [AppointmentApiController::class, 'counselorIndex']);
        Route::get('appointments/{appointment}/{id}', [AppointmentApiController::class, 'counselorShow']);
        Route::put('appointments/{appointment}{id}', [AppointmentApiController::class, 'counselorUpdate']);
    });

    // Logout
    Route::post('logout', [AuthApiController::class, 'logout']);
});
