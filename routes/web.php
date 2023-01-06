<?php

use Illuminate\Support\Facades\Route;

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

Route::match(['post', 'get'],'/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');


//Route::get('/login', function () {
//    return view('auth/login');
//});

Route::get('/admin', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin/master', [\App\Http\Controllers\MasterController::class, 'index'])->name('masterbarang');
Route::get('/admin/masterother', [\App\Http\Controllers\MasterOtherController::class, 'index'])->name('masterother');
Route::get('/admin/stock/kodebarang', [\App\Http\Controllers\DashboardController::class, 'stockbarang'])->name('stockbarang');



