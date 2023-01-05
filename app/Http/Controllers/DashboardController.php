<?php


namespace App\Http\Controllers;



class DashboardController
{

    public function index()
    {
        return view('admin.dashboard.dashboard', ['page' => 'dashboardPage']);
    }

     public function stockbarang()
    {
        return view('admin.dashboard.stock', ['page' => 'dashboardPage']);
    }
}
