<?php

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
Route::post('/marketings/search', [MarketingsController::class, 'search'])->name('api.marketings.search');
