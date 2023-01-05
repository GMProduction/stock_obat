<?php


namespace App\Http\Controllers;



class MasterController
{

    public function index()
    {
        return view('admin.master.master', ['page' => 'masterPage', 'subpage' => 'masterBarang']);
    }


}
