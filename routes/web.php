<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/* ---------------- Welcome ---------------- */
Route::get('/', fn () => view('welcome'))->name('welcome');

/* ---------------- Auth ---------------- */
Route::get('/login', [AuthenticatedSessionController::class,'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'store']);
Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class,'create'])->name('register');
Route::post('/register', [RegisteredUserController::class,'store']);

/* ---------------- Student ---------------- */
Route::middleware(['auth','role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentController::class,'dashboard'])
            ->name('dashboard');

        Route::resource('appointments', AppointmentController::class)
            ->only(['index','create','store','show','edit','update','destroy']);
    });


/* ---------------- Counselor ---------------- */
Route::middleware(['auth','role:counselor'])
    ->prefix('counselor')
    ->name('counselor.')
    ->group(function () {
        Route::get('/dashboard', [CounselorController::class,'dashboard'])->name('dashboard');
        Route::get('/appointments', [CounselorController::class,'appointments'])->name('appointments.index');
        Route::get('/appointments/{appointment}', [CounselorController::class,'showAppointment'])->name('appointments.show');
        Route::put('/appointments/{appointment}', [CounselorController::class,'updateAppointment'])->name('appointments.update');
    });

