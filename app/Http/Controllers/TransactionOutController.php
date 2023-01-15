<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Repository\MedicineOutRepository;

class TransactionOutController extends CustomController
{
    private $medicineOutRepository;

    public function __construct(MedicineOutRepository $medicineOutRepository)
    {
        parent::__construct();
        $this->medicineOutRepository = $medicineOutRepository;
    }

    public function store_cart()
    {
        try {
            $medicine_id = $this->postField('medicine');

            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
}
