<?php


namespace App\Http\Controllers;



class MasterLokasiController
{

    public function index()
    {
        return view('admin.master.masterlokasi', ['page' => 'masterPage', 'subpage' => 'masterLokasi']);
    }


}
