<?php


namespace App\Http\Controllers;



use App\Models\Medicine;
use App\Models\MedicineIn;
use App\Repository\MedicineRepository;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    private $medicineRepo;

    public function __construct(MedicineRepository $medicineRepository)
    {
        $this->medicineRepo = $medicineRepository;

    }

    public function datatableStock(){
        return $this->medicineRepo->showDatatableStock();
    }

    public function datatableExpired(){
        return $this->medicineRepo->showDatatableStockExpired();
    }

    public function index()
    {
        return view('admin.dashboard.dashboard');
    }


     public function stockbarang()
    {
        $data = Medicine::findOrFail(request('id'));
        return view('admin.dashboard.stock')->with(['data' => $data]);
    }

    public function datatableStockDetail(){
        return $this->medicineRepo->showDatatableStockDetail();
    }
}
