<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// guards determine how users are authenticated for each request (just like gatekeeper, determining the surety of the request)
// providers defines how users are retrieved from persistent storage (how do i fetch user data from db)
// middleware acts as filters that can inspect and modify request before they reach controllers ()
// listeners are classes that respond to specific events


Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');
    Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware('throttle:login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');
  //  Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/email/verify', [EmailVerificationController::class, 'index'])
    ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');

});

Route::middleware(['auth', 'verified'])->group(function(){

   // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  //  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::redirect('/', '/dashboard');
});


