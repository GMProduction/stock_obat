<?php


namespace App\Http\Controllers;



class PengeluaranController
{

    public function index()
    {
        return view('admin.pengeluaran.pengeluaran', ['page' => 'pengeluaranPage']);
    }

    public function tambah()
    {
        return view('admin.pengeluaran.keluaranbarang', ['page' => 'pengeluaranPage']);
    }

}
