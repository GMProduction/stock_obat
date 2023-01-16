<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Repository\MedicineOutRepository;
use App\Repository\MedicineRepository;

class TransactionOutController extends CustomController
{
    private $medicineOutRepository;
    private $medicineRepository;

    public function __construct(MedicineOutRepository $medicineOutRepository, MedicineRepository $medicineRepository)
    {
        parent::__construct();
        $this->medicineOutRepository = $medicineOutRepository;
        $this->medicineRepository = $medicineRepository;
    }

    public function store_cart()
    {
        try {
            $medicine_id = $this->postField('medicine');
            $qty = (int)$this->postField('qty');
            $real_stock = $this->medicineRepository->real_stock($medicine_id);
            return $this->jsonResponse('success', 200, $real_stock);
            $medicine = $this->medicineRepository->findById($medicine_id);
            $unit_id = $medicine->unit_id;
            if ($qty > $medicine->qty) {
                return $this->jsonResponse('stock tidak mencukupi', 400);
            }
            $data_request = [
                'medicine_id' => $medicine_id,
                'unit_id' => $unit_id,
                'qty' => $qty
            ];
            $this->medicineOutRepository->create($data_request);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
}
