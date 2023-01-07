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

Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::prefix('master')->group(function (){
    Route::get('', [\App\Http\Controllers\MasterController::class, 'index'])->name('masterbarang');
    Route::prefix('lokasi')->group(function (){
        Route::match(['POST','GET'],'', [\App\Http\Controllers\MasterLokasiController::class, 'index'])->name('masterlokasi');
        Route::get('datatable', [\App\Http\Controllers\MasterLokasiController::class, 'datatable'])->name('masterlokasidatatable');

    });
    Route::prefix('other')->group(function (){
        Route::get('', [\App\Http\Controllers\MasterOtherController::class, 'index'])->name('masterother');
        Route::post('patch/{type}', [\App\Http\Controllers\MasterOtherController::class, 'patch'])->name('patchOther');
        Route::get('datatable-unit', [\App\Http\Controllers\MasterOtherController::class, 'datatableUnit'])->name('datatableUnit');
        Route::get('datatable-budget', [\App\Http\Controllers\MasterOtherController::class, 'datatableBudget'])->name('datatableBudget');
    });

});
Route::get('/stock/kodebarang', [\App\Http\Controllers\DashboardController::class, 'stockbarang'])->name('stockbarang');



