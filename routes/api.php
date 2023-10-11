<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingsController;
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
