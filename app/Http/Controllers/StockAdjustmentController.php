<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Repository\MedicineRepository;
use App\Repository\MedicineStockRepository;

class StockAdjustmentController extends CustomController
{
    private $medicineRepository;
    private $medicineStockRepository;

    public function __construct(MedicineRepository $medicineRepository, MedicineStockRepository $medicineStockRepository)
    {
        parent::__construct();
        $this->medicineRepository = $medicineRepository;
        $this->medicineStockRepository = $medicineStockRepository;
    }

    public function index()
    {
        return view('admin.penyesuaian.penyesuaian');
    }

    public function add()
    {
        $medicines = $this->medicineRepository->findAll(['unit']);
        return view('admin.penyesuaian.add')->with(['medicines' => $medicines]);
    }

    public function stock()
    {
        try {
            $medicineId = $this->field('medicine');
            $data = $this->medicineStockRepository->getMedicineStockByMedicine($medicineId);
            return $this->jsonResponse('success', 200, $data);
        }catch (\Exception $e) {
            return $this->jsonResponse('internal server error...', 500);
        }
    }
}
