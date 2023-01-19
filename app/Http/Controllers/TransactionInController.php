<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\GeneralLedger;
use App\Models\Medicine;
use App\Models\MedicineIn;
use App\Models\TransactionIn;
use App\Repository\BudgetRepository;
use App\Repository\MedicineInRepository;
use App\Repository\MedicineRepository;
use App\Repository\TransactionInRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class TransactionInController extends CustomController
{
    private $transactionInRepository;
    private $medicineRepository;
    private $budgetSourceRepository;

    public function __construct(TransactionInRepository $transactionInRepository, MedicineRepository $medicineRepository, BudgetRepository $budgetSourceRepository)
    {
        parent::__construct();
        $this->transactionInRepository = $transactionInRepository;
        $this->medicineRepository = $medicineRepository;
        $this->budgetSourceRepository = $budgetSourceRepository;
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
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        if ($this->request->ajax()) {
            $data = $this->transactionInRepository->cart(['medicine', 'unit']);
            return $this->basicDataTables($data);
        }
        $medicines = $this->medicineRepository->findAll(['unit']);
        $budget_sources = $this->budgetSourceRepository->getAll();
        $total = $this->transactionInRepository->cart()->sum('total');
        return view('admin.penerimaan.tambahbarang')->with(['medicines' => $medicines, 'budget_sources' => $budget_sources, 'total' => $total]);
    }

    public function storeCart()
    {
        try {
            $medicine_id = $this->postField('medicine');
            $qty = (int)$this->postField('qty');
            $price = (int)$this->postField('price');
            $total = $qty * $price;
            $expired_date = $this->postField('expired_date');
            $expired_date_value = Carbon::parse($expired_date)->format('Y-m-d');
            $medicine = $this->transactionInRepository->medicineById($medicine_id);
            $unit_id = $medicine->unit_id;
            $data_request = [
                'user_id' => 1,
                'transaction_in_id' => null,
                'medicine_id' => $medicine_id,
                'unit_id' => $unit_id,
                'expired_date' => $expired_date_value,
                'qty' => $qty,
                'price' => $price,
                'total' => $total,
                'rest' => $qty,
            ];
            $this->transactionInRepository->addToCart($data_request);
            return redirect()->back()->with('success', 'Berhasil menambahkan data...');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan server...' . $e->getMessage());
        }
    }

    private function store()
    {
        DB::beginTransaction();
        try {
            $author = 1;
            $budget_source_id = $this->postField('budget_source');
            $date = $this->postField('date');
            $date_value = Carbon::parse($date)->format('Y-m-d');
            $batch_id = 'TI-' . date('YmdHis');
            $description = $this->postField('description') ?? '-';
            $data_request = [
                'user_id' => $author,
                'budget_source_id' => $budget_source_id,
                'date' => $date_value,
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
                $this->transactionInRepository->addStock($medicine_id, $addedStock);
                $general_ledger_data = [
                    'date' => $date_value,
                    'medicine_in_id' => $medicine_in_id,
                    'transaction_in_id' => $transaction_in->id,
                    'qty' => $addedStock,
                    'type' => 0,
                    'description' => $description
                ];
                $this->transactionInRepository->saveToGeneralLedger($general_ledger_data);
            }
            DB::commit();
            return redirect()->route('penerimaanbarang')->with('success', 'Berhasil menambahkan data...');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Terjadi kesalahan server...' . $e->getMessage());
        }
    }

    public function cetakSuratPenerimaan($id)
    {
//        return $this->dataTransaksi($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataTransaksi($id))->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataTransaksi($id)
    {
        $trans = ['id' => 'penerimaanPage'];
//        return $trans;
        return view('admin.penerimaan.suratpenerimaan',['data' => $id]);
    }

    public function detailpenerimaan($id){
        return view('admin.penerimaan.detailpenerimaan');
    }
}
