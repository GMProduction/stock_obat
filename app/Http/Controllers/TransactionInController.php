<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use Illuminate\Support\Facades\DB;

class TransactionInController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $data_request = [
                'user_id' => 1.
            ];
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
}
