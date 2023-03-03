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


Route::middleware('auth')->group(
    function () {
        Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('/')->group(
            function () {
                Route::get('', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
                Route::get('stock/{id}', [\App\Http\Controllers\DashboardController::class, 'stockbarang'])->name('stockbarang');
                Route::get('stock/{id}/datatable', [\App\Http\Controllers\DashboardController::class, 'datatableStockDetail'])->name('stockbarang.datatable');
                Route::get('datatable-stock', [\App\Http\Controllers\DashboardController::class, 'datatableStock'])->name('dashboardstock');
                Route::get('datatable-expired', [\App\Http\Controllers\DashboardController::class, 'datatableExpired'])->name('dashboardexpired');
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
            }
        );
        Route::get('/penyesuaian', [\App\Http\Controllers\LaporanController::class, 'penyesuaian'])->name('penyesuaian');

        Route::prefix('penyesuaian')->group(function () {
            Route::get('/', [\App\Http\Controllers\StockAdjustmentController::class, 'index'])->name('penyesuaian');
            Route::match(['post', 'get'],'/tambah', [\App\Http\Controllers\StockAdjustmentController::class, 'add'])->name('tambahpenyesuaian');
            Route::match(['post', 'get'],'/stock', [\App\Http\Controllers\StockAdjustmentController::class, 'stock'])->name('penyesuaian.stock');
            Route::get('/{id}/detail', [\App\Http\Controllers\StockAdjustmentController::class, 'detail'])->name('penyesuaian.detail');
            Route::get('/{id}/cetak', [\App\Http\Controllers\StockAdjustmentController::class, 'print_detail'])->name('penyesuaian.pdf');
        });

        Route::prefix('penerimaan')->group(function () {
            Route::get('/', [\App\Http\Controllers\TransactionInController::class, 'index'])->name('penerimaanbarang');
            Route::get('/{id}/detail', [\App\Http\Controllers\TransactionInController::class, 'detail'])->name('penerimaanbarang.detail');
            Route::get('/{id}/cetak', [\App\Http\Controllers\TransactionInController::class, 'print_transaction_in'])->name('penerimaanbarang.cetak');
            Route::match(['get', 'post'], '/tambah', [\App\Http\Controllers\TransactionInController::class, 'add'])->name('tambahbarang');
            Route::post('/tambah/cart', [\App\Http\Controllers\TransactionInController::class, 'storeCart'])->name('tambahbarang.cart');
            Route::post('/destroy/cart', [\App\Http\Controllers\TransactionInController::class, 'delete_cart'])->name('tambahbarang.cart.destroy');
        });

        Route::prefix('pengeluaran')->group(
            function () {
                Route::get('/', [\App\Http\Controllers\TransactionOutController::class, 'index'])->name('pengeluaran');
                Route::get('/{id}/detail', [\App\Http\Controllers\TransactionOutController::class, 'detail'])->name('pengeluaran.detail');
                Route::get('/{id}/cetak', [\App\Http\Controllers\TransactionOutController::class, 'print_transaction_out'])->name('pengeluaran.cetak');
                Route::match(['get', 'post'], '/tambah', [\App\Http\Controllers\TransactionOutController::class, 'add'])->name('pengeluaranbarang');
                Route::post('/tambah/cart', [\App\Http\Controllers\TransactionOutController::class, 'store_cart'])->name('pengeluaranbarang.cart');
                Route::post('/destroy/cart', [\App\Http\Controllers\TransactionOutController::class, 'delete_cart'])->name('pengeluaranbarang.cart.destroy');
            }
        );

        Route::prefix('laporan')->group(
            function () {
                // Route::get('/', [\App\Http\Controllers\TransactionOutController::class, 'index'])->name('pengeluaran');
                Route::get('/stock', [\App\Http\Controllers\StockReportController::class, 'index'])->name('laporanstock');
                Route::get('/stock/excel', [\App\Http\Controllers\StockReportController::class, 'exportToExcel'])->name('laporanstock.excel');
                Route::get('/stock/pdf', [\App\Http\Controllers\StockReportController::class, 'printToPDF'])->name('laporanstock.pdf');
                Route::get('/stock-data', [\App\Http\Controllers\LaporanController::class, 'stock'])->name('laporanstockdata');
                Route::get('/stock/{id}/detail', [\App\Http\Controllers\LaporanController::class, 'detailstock'])->name('laporandetailstock');
                Route::get('/penerimaan', [\App\Http\Controllers\ReportTransactionInController::class, 'index'])->name('laporanpenerimaan');
                Route::get('/penerimaan/{id}/detail', [\App\Http\Controllers\ReportTransactionInController::class, 'detail'])->name('laporanpenerimaan.detail');
                Route::get('/penerimaan/excel', [\App\Http\Controllers\ReportTransactionInController::class, 'exportToExcel'])->name('laporanpenerimaan.excel');
                Route::get('/penerimaan/pdf', [\App\Http\Controllers\ReportTransactionInController::class, 'printToPDF'])->name('laporanpenerimaan.pdf');
                Route::get('/laporanpenerimaan/{id}', [\App\Http\Controllers\LaporanController::class, 'cetakLaporanPenerimaan'])->name('cetakLaporanPenerimaan');
                Route::get('/barangkeluar', [\App\Http\Controllers\ReportTransactionOutController::class, 'index'])->name('laporanbarangkeluar');
                Route::get('/barangkeluar/excel', [\App\Http\Controllers\ReportTransactionOutController::class, 'exportToExcel'])->name('laporanbarangkeluar.excel');
                Route::get('/barangkeluar/pdf', [\App\Http\Controllers\ReportTransactionOutController::class, 'printToPDF'])->name('laporanbarangkeluar.pdf');
                Route::get('/laporanbarangkeluar/{id}', [\App\Http\Controllers\LaporanController::class, 'cetakLaporanBarangKeluar'])->name('cetakLaporanBarangKeluar');
                Route::get('/laporanjurnal', [\App\Http\Controllers\LaporanController::class, 'laporanJurnalUmum'])->name('laporanjurnal');
                Route::get('/laporanjurnal/excel', [\App\Http\Controllers\LaporanController::class, 'laporanjurnalExcel'])->name('laporanjurnal.excel');
                Route::get('/jurnalbarang', [\App\Http\Controllers\LaporanController::class, 'jurnalbarang'])->name('jurnalbarang');
                Route::get('/jurnal', [\App\Http\Controllers\GeneralLedgerReportController::class, 'index'])->name('jurnal');
                Route::get('/jurnal/excel', [\App\Http\Controllers\GeneralLedgerReportController::class, 'excel'])->name('jurnal.excel');
                Route::get('/jurnal/pdf', [\App\Http\Controllers\GeneralLedgerReportController::class, 'printToPDF'])->name('jurnal.pdf');
                Route::get('/penyesuaian', [\App\Http\Controllers\ReportAdjustmentController::class, 'index'])->name('adjustment');
                Route::get('/penyesuaian/excel', [\App\Http\Controllers\ReportAdjustmentController::class, 'excel'])->name('adjustment.excel');
                Route::get('/penyesuaian/pdf', [\App\Http\Controllers\ReportAdjustmentController::class, 'printToPDF'])->name('adjustment.pdf');

            }
        );
    }
);
