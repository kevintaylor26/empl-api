<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::middleware('guest')->get('/', [HomeController::class, 'index']);
Route::middleware('auth')->get('/home', [HomeController::class, 'home']);
Route::get('/signin', [AuthController::class, 'loginPage'])->name('auth.loginPage');
Route::get('/signup', [AuthController::class, 'signupPage'])->name('auth.signupPage');
Route::get('/signout', [AuthController::class, 'signout'])->name('api.auth.signout');


