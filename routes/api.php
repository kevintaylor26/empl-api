<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/marketings/list', [MarketingsController::class, 'list'])->name('api.marketings.list');
Route::post('/marketings/topRates', [MarketingsController::class, 'topRates'])->name('api.marketings.topRates');
Route::post('/marketings/free_search', [MarketingsController::class, 'free_search'])->name('api.marketings.free_search');
Route::post('/auth/signin', [AuthController::class, 'login'])->name('api.auth.login');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('api.auth.signup');
Route::middleware('auth')->post('/auth/autologin', [AuthController::class, 'autologin'])->name('api.auth.autologin');
Route::middleware('auth')->post('/auth/changePassword', [AuthController::class, 'changePassword'])->name('api.auth.changePassword');
Route::middleware('auth')->post('/marketings/search', [MarketingsController::class, 'search'])->name('api.marketings.search');
Route::middleware('auth')->post('/marketings/admin_search', [MarketingsController::class, 'admin_search'])->name('api.marketings.admin_search');
Route::middleware('auth')->post('/users/users_search', [UsersController::class, 'users_search'])->name('api.users.users_search');
Route::middleware('auth')->post('/payments/payments_search', [PaymentsController::class, 'payments_search'])->name('api.payments.payments_search');
