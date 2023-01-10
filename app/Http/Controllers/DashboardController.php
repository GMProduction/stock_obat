<?php


namespace App\Http\Controllers;



class DashboardController
{

    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

     public function stockbarang()
    {
        return view('admin.dashboard.stock');
    }
}
