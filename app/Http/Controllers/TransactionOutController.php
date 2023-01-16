<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Repository\MedicineOutRepository;
use App\Repository\MedicineRepository;
use App\Repository\TransactionOutRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TransactionOutController extends CustomController
{
    private $transactionOutRepository;

    public function __construct(TransactionOutRepository $transactionOutRepository)
    {
        parent::__construct();
        $this->transactionOutRepository = $transactionOutRepository;
    }

    public function store_cart()
    {
        try {
            $medicine_id = $this->postField('medicine');
            $qty = (int)$this->postField('qty');
            $medicine = $this->transactionOutRepository->findMedicineByID($medicine_id);
            $unit_id = $medicine->unit_id;
            $current_stock = $medicine->qty;
            if ($qty > $current_stock) {
                return $this->jsonResponse('stock tidak mencukupi', 400);
            }

            //validate general ledgers
            $available_stocks = $this->transactionOutRepository->getAvailableStock($medicine_id);
            $general_ledgers = $this->generateGeneralLedger($available_stocks, $qty);
            $avg_price = $general_ledgers['avg_price'];
            if ($general_ledgers['error']) {
                return $this->jsonResponse('failed to create general ledger', 400);
            }
            $data_request = [
                'medicine_id' => $medicine_id,
                'unit_id' => $unit_id,
                'qty' => $qty,
                'price' => $avg_price,
                'total' => ($qty * $avg_price)
            ];
            $this->transactionOutRepository->addToCart($data_request);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $author = 1;
            $date = Carbon::now();
            $location_id = $this->postField('location');
//            $date_value = Carbon::parse($date)->format('Y-m-d');
            $batch_id = 'TI-' . date('YmdHis');
            $description = $this->postField('description') ?? '-';
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
    private function generateGeneralLedger($available_stocks, $qty)
    {
        $tmp_rest = $qty;
        $tmp_general_ledgers = [];
        foreach ($available_stocks as $available_stock) {
            if ($tmp_rest <= 0) {
                break;
            }
            $tmp_qty = $available_stock->rest;
            $tmp_price = $available_stock->price;
            $medicine_in_id = $available_stock->id;
            if ($tmp_qty >= $tmp_rest) {
                array_push($tmp_general_ledgers, [
                    'medicine_in_id' => $medicine_in_id,
                    'qty' => $tmp_rest,
                    'price' => $tmp_price,
                    'total' => ($tmp_rest * $tmp_price)
                ]);
                $tmp_rest = 0;
            } else {
                $tmp_rest = $tmp_rest - $tmp_qty;
                array_push($tmp_general_ledgers, [
                    'medicine_in_id' => $medicine_in_id,
                    'qty' => $tmp_qty,
                    'price' => $tmp_price,
                    'total' => ($tmp_qty * $tmp_price)
                ]);
            }
        }
        $error = false;
        if ($tmp_rest > 0) {
            $error = true;
        }
        $tmp_summary_total = array_reduce($tmp_general_ledgers, function ($sum, $entry) {
            $sum += $entry['total'];
            return $sum;
        }, 0);

        $tmp_summary_qty = array_reduce($tmp_general_ledgers, function ($sum, $entry) {
            $sum += $entry['qty'];
            return $sum;
        }, 0);
        $avg_price = round(($tmp_summary_total / $tmp_summary_qty), 0);
        return [
            'error' => $error,
            'data' => $tmp_general_ledgers,
            'avg_price' => $avg_price
        ];
    }
}
