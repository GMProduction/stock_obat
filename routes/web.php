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

Route::match(['post', 'get'], '/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

//Route::get('/login', function () {
//    return view('auth/login');
//});

Route::middleware('auth')->group(
    function () {
        Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

        Route::prefix('/')->group(
            function () {
                Route::get('', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
                Route::get('stock/{id}', [\App\Http\Controllers\DashboardController::class, 'stockbarang'])->name('stockbarang');
                Route::get('datatable-stock', [\App\Http\Controllers\DashboardController::class, 'datatableStock'])->name('dashboardstock');
            }
        );
        Route::prefix('master')->group(
            function () {
                Route::match(['POST', 'GET'], '/', [\App\Http\Controllers\MasterController::class, 'index'])->name('masterbarang');
                Route::get('datatable', [\App\Http\Controllers\MasterController::class, 'datatable'])->name('masterdatatable');
                Route::prefix('lokasi')->group(
                    function () {
                        Route::match(['POST', 'GET'], '', [\App\Http\Controllers\MasterLokasiController::class, 'index'])->name('masterlokasi');
                        Route::get('datatable', [\App\Http\Controllers\MasterLokasiController::class, 'datatable'])->name('masterlokasidatatable');
                    }
                );
                Route::prefix('other')->group(
                    function () {
                        Route::get('', [\App\Http\Controllers\MasterOtherController::class, 'index'])->name('masterother');
                        Route::post('patch/{type}', [\App\Http\Controllers\MasterOtherController::class, 'patch'])->name('patchOther');
                        Route::get('datatable-unit', [\App\Http\Controllers\MasterOtherController::class, 'datatableUnit'])->name('datatableUnit');
                        Route::get('datatable-budget', [\App\Http\Controllers\MasterOtherController::class, 'datatableBudget'])->name('datatableBudget');
                        Route::get('unit-json', [\App\Http\Controllers\MasterOtherController::class, 'getAllUnit'])->name('unitjson');
                        Route::get('budget-json', [\App\Http\Controllers\MasterOtherController::class, 'getAllBudget'])->name('budgetjson');
                    }
                );
                Route::prefix('category')->group(
                    function () {
                        Route::get('json', [\App\Http\Controllers\CategoryController::class, 'getAll'])->name('categoryjson');
                    }
                );

//                Route::get('', [\App\Http\Controllers\MasterOtherController::class, 'index'])->name('masterother');
//                Route::post('patch/{type}', [\App\Http\Controllers\MasterOtherController::class, 'patch'])->name('patchOther');
//                Route::get('datatable-unit', [\App\Http\Controllers\MasterOtherController::class, 'datatableUnit'])->name('datatableUnit');
//                Route::get('datatable-budget', [\App\Http\Controllers\MasterOtherController::class, 'datatableBudget'])->name('datatableBudget');
//                Route::get('unit-json', [\App\Http\Controllers\MasterOtherController::class, 'getAllUnit'])->name('unitjson');
//                Route::get('budget-json', [\App\Http\Controllers\MasterOtherController::class, 'getAllBudget'])->name('budgetjson');
            }
        );
        Route::prefix('penerimaan')->group(function () {
            Route::get('/', [\App\Http\Controllers\TransactionInController::class, 'index'])->name('penerimaanbarang');
            Route::get('/{id}/detail', [\App\Http\Controllers\TransactionInController::class, 'detail'])->name('penerimaanbarang.detail');
            Route::match(['get', 'post'], '/tambah', [\App\Http\Controllers\TransactionInController::class, 'add'])->name('tambahbarang');
            Route::post('/tambah/cart', [\App\Http\Controllers\TransactionInController::class, 'storeCart'])->name('tambahbarang.cart');
            Route::post('/destroy/cart', [\App\Http\Controllers\TransactionInController::class, 'delete_cart'])->name('tambahbarang.cart.destroy');
        });

        Route::prefix('pengeluaran')->group(
            function () {
                Route::get('/', [\App\Http\Controllers\TransactionOutController::class, 'index'])->name('pengeluaran');
                Route::match(['get', 'post'], '/tambah', [\App\Http\Controllers\TransactionOutController::class, 'add'])->name('pengeluaranbarang');
                Route::post('/tambah/cart', [\App\Http\Controllers\TransactionOutController::class, 'store_cart'])->name('pengeluaranbarang.cart');
                Route::post('/destroy/cart', [\App\Http\Controllers\TransactionOutController::class, 'delete_cart'])->name('pengeluaranbarang.cart.destroy');
                Route::get('/detail/{id}', [\App\Http\Controllers\TransactionOutController::class, 'detailpengeluaran'])->name('detailpengeluaran');
            }
        );
    }
);


