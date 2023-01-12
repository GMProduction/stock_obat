<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\GeneralLedger;
use App\Models\Medicine;
use App\Models\MedicineIn;
use App\Models\TransactionIn;
use App\Repository\MedicineInRepository;
use App\Repository\TransactionInRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionInController extends CustomController
{
    private $transactionInRepository;
    public function __construct(TransactionInRepository $transactionInRepository)
    {
        parent::__construct();
        $this->transactionInRepository = $transactionInRepository;
    }

    public function storeCart()
    {
        try {
            $medicine_id = $this->postField('medicine');
            $medicine = Medicine::find($medicine_id);
            $medicineOnCart = $this->transactionInRepository->medicineOnCart($medicine_id);
            $qty = (int)$this->postField('qty');
            $price = (int)$this->postField('price');
            $total = $qty * $price;
            if ($medicineOnCart) {
                $qty = $medicineOnCart->qty + $qty;
                $total = $qty * $price;
                $medicineOnCart->update([
                    'qty' => $qty,
                    'price' => $price,
                    'total' => $total
                ]);
            } else {
                $data_request = [
                    'user_id' => 1,
                    'transaction_in_id' => null,
                    'medicine_id' => $medicine->id,
                    'unit_id' => $medicine->unit_id,
                    'expired_date' => $this->postField('expired_date'),
                    'qty' => $qty,
                    'price' => $price,
                    'total' => $total,
                ];
                MedicineIn::create($data_request);
            }
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $data_request = [
                'user_id' => 1,
                'budget_source_id' => $this->postField('budget_source'),
                'date' => Carbon::now(),
                'batch_id' => 'TI-' . date('YmdHis'),
                'description' => $this->postField('description')
            ];
            $transaction_in = TransactionIn::create($data_request);
            $cart = $this->transactionInRepository->cart();


            $medicine_ins = MedicineIn::whereNull('transaction_in_id')->get();
            foreach ($medicine_ins as $medicine_in) {
                $medicine_in->update([
                    'transaction_in_id' => $transaction_in->id
                ]);
                $qty_in = $medicine_in->qty;
                $medicine = Medicine::find($medicine_in->medicine_id);
                $current_qty = $medicine->qty;
                $new_qty = $qty_in + $current_qty;
                $medicine->update([
                    'qty' => $new_qty
                ]);
                GeneralLedger::create([
                    'date' => Carbon::now(),
                    'medicine_in_id' => $medicine_in->id,
                    'transaction_in_id' => $transaction_in->id,
                    'qty' => $qty_in,
                    'type' => 0,
                    'description' => $this->postField('description') ?? '-'
                ]);
            }
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
}
