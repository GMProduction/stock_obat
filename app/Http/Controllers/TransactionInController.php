<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\GeneralLedger;
use App\Models\Medicine;
use App\Models\MedicineIn;
use App\Models\TransactionIn;
use App\Repository\MedicineInRepository;
use App\Repository\MedicineRepository;
use App\Repository\TransactionInRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionInController extends CustomController
{
    private $transactionInRepository;
    private $medicineRepository;

    public function __construct(TransactionInRepository $transactionInRepository, MedicineRepository $medicineRepository)
    {
        parent::__construct();
        $this->transactionInRepository = $transactionInRepository;
        $this->medicineRepository = $medicineRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = $this->transactionInRepository->getData();
            return $this->basicDataTables($data);
        }
        return view('admin.penerimaan.penerimaan');
    }

    public function add()
    {
        if ($this->request->ajax()) {
            $data = $this->transactionInRepository->cart(['medicine', 'unit']);
            return $this->basicDataTables($data);
        }
        $medicines = $this->medicineRepository->findAll(['unit']);
        return view('admin.penerimaan.tambahbarang')->with(['medicines' => $medicines]);
    }

    public function storeCart()
    {
        try {
            $medicine_id = $this->postField('medicine');
            $qty = (int)$this->postField('qty');
            $price = (int)$this->postField('price');
            $total = $qty * $price;
            $expired_date = $this->postField('expired_date');
            $medicine = $this->transactionInRepository->medicineById($medicine_id);
            $unit_id = $medicine->unit_id;
            $data_request = [
                'user_id' => 1,
                'transaction_in_id' => null,
                'medicine_id' => $medicine_id,
                'unit_id' => $unit_id,
                'expired_date' => $expired_date,
                'qty' => $qty,
                'price' => $price,
                'total' => $total,
            ];
            $this->transactionInRepository->addToCart($data_request);
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
            $budget_source_id = $this->postField('budget_source');
            $date = Carbon::now();
            $batch_id = 'TI-' . date('YmdHis');
            $description = $this->postField('description') ?? '-';
            $data_request = [
                'user_id' => $author,
                'budget_source_id' => $budget_source_id,
                'date' => $date,
                'batch_id' => $batch_id,
                'description' => $description
            ];
            $transaction_in = $this->transactionInRepository->create($data_request);
            $cart = $this->transactionInRepository->cart();
            $this->transactionInRepository->setTransactionIdToCart($transaction_in->id);
            foreach ($cart as $item) {
                $medicine_in_id = $item->id;
                $medicine_id = $item->medicine_id;
                $addedStock = $item->qty;
                $this->transactionInRepository->patchStock($medicine_id, $addedStock);
                $general_ledger_data = [
                    'date' => $date,
                    'medicine_in_id' => $medicine_in_id,
                    'transaction_in_id' => $transaction_in->id,
                    'qty' => $addedStock,
                    'type' => 0,
                    'description' => $description
                ];
                $this->transactionInRepository->saveToGeneralLedger($general_ledger_data);
            }
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), 500);
        }
    }
}
