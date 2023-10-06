<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/signin', [AuthController::class, 'loginPage'])->name('auth.loginPage');
Route::get('/signup', [AuthController::class, 'signupPage'])->name('auth.signupPage');


