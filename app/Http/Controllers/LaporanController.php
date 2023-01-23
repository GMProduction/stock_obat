<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;


class LaporanController
{

      // STOCK
      public function stock()
      {
          return view('admin.laporan.stock');
      }


    // PENERIMAAN BARANG
    public function penerimaan()
    {
        return view('admin.laporan.penerimaan');
    }

    public function cetakLaporanPenerimaan($id)
    {
        //        return $this->dataTransaksi($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->datapenerimaan($id))->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function datapenerimaan($id)
    {
        //        return $trans;
        return view('admin.laporan.cetakpenerimaan');
    }


    // BARANG KELUAR
    public function barangkeluar()
    {
        return view('admin.laporan.barangkeluar');
    }

    public function cetakLaporanBarangKeluar($id)
    {
        //        return $this->dataTransaksi($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataBarangKeluar($id))->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataBarangKeluar($id)
    {
        //        return $trans;
        return view('admin.laporan.cetakbarangkeluar');
    }
}
