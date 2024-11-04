<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::inertia('/', 'Home')->name('home');


// ----------Auth------------- 
// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//Logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/name', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
