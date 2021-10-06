<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\clientController;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

// Client
Route::middleware('auth')->group(function () {
    Route::get('/', [clientController::class, 'index'])
    ->withoutMiddleware('auth');

    Route::get('/offer/{product}', [clientController::class, 'detail'])
    ->withoutMiddleware('auth')
    ->name('offer_detail');

    Route::post('/offer/{product}/bid', [clientController::class, 'placeBid'])
    ->name('place_bid');
});

// Admin
Route::resource('products', adminDashboardController::class)->middleware('admin');
