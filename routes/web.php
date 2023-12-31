<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;

Route::middleware('guest')->get('/', [HomeController::class, 'index']);
Route::middleware('auth')->get('/home', [HomeController::class, 'home'])->name('home');
Route::middleware('auth')->get('/admin_panel', [AdminController::class, 'admin_panel']);
Route::middleware('auth')->get('/users_management', [AdminController::class, 'users']);
Route::middleware('auth')->get('/payments_management', [AdminController::class, 'payments']);
Route::middleware('auth')->get('/payout', [PaymentsController::class, 'payout']);
Route::get('/signin', [AuthController::class, 'loginPage'])->name('auth.loginPage');
Route::get('/signup', [AuthController::class, 'signupPage'])->name('auth.signupPage');
Route::get('/signout', [AuthController::class, 'signout'])->name('api.auth.signout');
Route::get('/download', [MarketingsController::class, 'download'])->name('marketings.download');
Route::get('/payment_hook', [PaymentsController::class, 'payment_hook'])->name('payments.payment_hook');
Route::middleware('auth')->get('/paySuccess', [PaymentsController::class, 'paySuccess'])->name('payments.paySuccess');
Route::middleware('auth')->get('/admin_download', [MarketingsController::class, 'admin_download'])->name('marketings.admin_download');
Route::middleware('auth')->get('/users/download', [AdminController::class, 'users_download'])->name('admin.users.download');


