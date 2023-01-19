<?php


namespace App\Http\Controllers;



use App\Repository\MedicineRepository;

class DashboardController extends Controller
{
    private $medicineRepo;

    public function __construct(MedicineRepository $medicineRepository)
    {
        $this->medicineRepo = $medicineRepository;

    }

    public function datatableExpiured(){

    }


    public function datatableStock(){
        return $this->medicineRepo->showDatatableStock();
    }

    public function index()
    {
        return view('admin.dashboard.dashboard');
    }


     public function stockbarang()
    {
        return view('admin.dashboard.stock');
    }

    public function datatableStockDetail(){
        return $this->medicineRepo->showDatatableStock();
    }
}
