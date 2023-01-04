<?php


namespace App\Http\Controllers;



class MasterOtherController
{

    public function index()
    {
        return view('admin.master.masterother', ['page' => 'masterPage', 'subpage' => 'masterBarang']);
    }


}
