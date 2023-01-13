<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;

class TransactionOutController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store_cart()
    {
        try {
            $medicine_id = $this->postField('medicine');

            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
}
