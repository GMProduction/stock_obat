<?php


namespace App\Http\Controllers;



class LaporanController
{

    public function penerimaan()
    {
        return view('admin.laporan.penerimaan');
    }

    public function pengeluaran()
    {
        return view('admin.laporan.pengeluaran');
    }

}
