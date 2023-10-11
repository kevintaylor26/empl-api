<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;

Route::middleware('guest')->get('/', [HomeController::class, 'index']);
Route::middleware('auth')->get('/home', [HomeController::class, 'home']);
Route::middleware('auth')->get('/payout', [PaymentsController::class, 'payout']);
Route::get('/signin', [AuthController::class, 'loginPage'])->name('auth.loginPage');
Route::get('/signup', [AuthController::class, 'signupPage'])->name('auth.signupPage');
Route::get('/signout', [AuthController::class, 'signout'])->name('api.auth.signout');
Route::get('/download', [MarketingsController::class, 'download'])->name('marketings.download');
Route::get('/payment_hook', [PaymentsController::class, 'payment_hook'])->name('payments.payment_hook');
Route::middleware('auth')->get('/paySuccess', [PaymentsController::class, 'paySuccess'])->name('payments.paySuccess');


