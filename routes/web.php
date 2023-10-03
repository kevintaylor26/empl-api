<?php

use App\Http\Controllers\MarketingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('students', StudentController::class);


Route::post('/marketings/list', [MarketingsController::class, 'list'])->name('api.marketings.list');
Route::post('/marketings/topRates', [MarketingsController::class, 'topRates'])->name('api.marketings.topRates');

