<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\adminDashboardController;

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
    return view('./clients/product_overview');
});

Auth::routes();

//Admin
Route::get('/dashboard', [App\Http\Controllers\adminDashboardController::class, 'index'])->name('dashboard');
Route::post('/add_product', [App\Http\Controllers\adminDashboardController::class, 'addProduct'])->name('test');
