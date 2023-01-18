<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;


class PenerimaanController
{

    public function index()
    {
        return view('admin.penerimaan.penerimaan', ['page' => 'penerimaanPage']);
    }

    public function tambah()
    {
        return view('admin.penerimaan.tambahbarang', ['page' => 'penerimaanPage']);
    }


}
