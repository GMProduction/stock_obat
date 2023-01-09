<?php


namespace App\Http\Controllers;



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
