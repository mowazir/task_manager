<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// guards determine how users are authenticated for each request (just like gatekeeper, determining the surety of the request)
// providers defines how users are retrieved from persistent storage (how do i fetch user data from db)
// middleware acts as filters that can inspect and modify request before they reach controllers ()

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
  //  Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function(){
   // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  //  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::redirect('/', '/dashboard');
});


