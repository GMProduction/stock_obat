<?php


namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Location;
use App\Models\Medicine;
use Illuminate\Support\Facades\App;


class LaporanController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    // STOCK
    public function stock()
    {
        $this->getStock();
        return view('admin.laporan.stock');
    }


    // JURNAL BARANG
    public function jurnalbarang()
    {
        $this->getStock();
        return view('admin.laporan.jurnalbarang');
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

    public function getStock()
    {
        try {
            $data = Medicine::with(['stocks' => function ($q) {
                //                return $q->where('location_id', '=', 2);
            }])
                ->get();

            $results = [];
            $locations = Location::all();
            foreach ($data as $value) {
                $tmp['id'] = $value->id;
                $tmp['name'] = $value->name;
                $tmpLocations = [];
                $tmpMainLocation['index'] = 0;
                $tmpMainLocation['name'] = 'Gudang Utama';
                $tmpMainLocation['qty'] = $value->qty;
                array_push($tmpLocations, $tmpMainLocation);
                foreach ($locations as $key => $location) {
                    $tmpLocation['index'] = ($key + 1);
                    $tmpLocation['name'] = $location->name;
                    $tmpStock = $value->stocks->firstWhere('location_id', '=', $location->id);
                    $tmpQty = $tmpStock !== null ? $tmpStock->qty : 0;
                    $tmpLocation['qty'] = $tmpQty;
                    array_push($tmpLocations, $tmpLocation);
                }
                $tmp['stocks'] = $tmpLocations;
                array_push($results, $tmp);
            }
            return $this->basicDataTables($results);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }
}
