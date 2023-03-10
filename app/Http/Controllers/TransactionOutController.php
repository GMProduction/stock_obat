<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Location;
use App\Models\MedicineOut;
use App\Models\MedicineStock;
use App\Repository\LocationRepository;
use App\Repository\MedicineOutRepository;
use App\Repository\MedicineRepository;
use App\Repository\TransactionOutRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class TransactionOutController extends CustomController
{
    private $transactionOutRepository;
    private $medicineRepository;
    private $locationRepository;

    public function __construct(TransactionOutRepository $transactionOutRepository, MedicineRepository $medicineRepository, LocationRepository $locationRepository)
    {
        parent::__construct();
        $this->transactionOutRepository = $transactionOutRepository;
        $this->medicineRepository = $medicineRepository;
        $this->locationRepository = $locationRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = $this->transactionOutRepository->getData(['location']);
            return $this->basicDataTables($data);
        }
        return view('admin.pengeluaran.pengeluaran');
    }

    public function add()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->store();
        }
        $carts = $this->transactionOutRepository->cart(['medicine', 'unit']);
        if ($this->request->ajax()) {
            return $this->basicDataTables($carts);
        }
        $locations = $this->locationRepository->findAll();
        $medicines = $this->medicineRepository->findAll(['unit']);

        return view('admin.pengeluaran.keluaranbarang')->with(['locations' => $locations, 'medicines' => $medicines, 'carts' => $carts]);
    }

    public function store_cart()
    {
        DB::beginTransaction();
        try {
            $medicine_id = $this->postField('medicine');
            $qty = (int)$this->postField('qty');
            $medicine = $this->transactionOutRepository->findMedicineByID($medicine_id);
            $unit_id = $medicine->unit_id;
//            $current_stock = $medicine->qty;
//            if ($qty > $current_stock) {
//                return $this->jsonResponse('stock tidak mencukupi', 500);
//            }

            //validate general ledgers
//            $available_stocks = $this->transactionOutRepository->getAvailableStock($medicine_id);
//            $general_ledgers = $this->generateGeneralLedger($available_stocks, $qty);
//            $avg_price = $general_ledgers['avg_price'];
//            if ($general_ledgers['error']) {
//                return $this->jsonResponse('failed to create general ledger', 500);
//            }
//            $data_request = [
//                'medicine_id' => $medicine_id,
//                'unit_id' => $unit_id,
//                'qty' => $qty,
//                'price' => $avg_price,
//                'total' => ($qty * $avg_price)
//            ];
//            $this->transactionOutRepository->addToCart($data_request);
            $medicine_stocks = $this->transactionOutRepository->getMedicineStocks($medicine_id);
            $totalQty = $medicine_stocks->sum('qty');
            if ($qty > $totalQty) {
                return $this->jsonResponse('stock tidak mencukupi', 500);
            }
            $medicineOuts = [];
            $requestedQty = $qty;
            foreach ($medicine_stocks as $medicine_stock) {
                $availableQty = $medicine_stock->qty;
                $medicine_stock_id = $medicine_stock->id;
                $medicine_id = $medicine_stock->medicine_id;
                $expired_date = $medicine_stock->expired_date;
                $unit_id = $medicine_stock->medicine->unit_id;
                if ($requestedQty === 0 || $requestedQty <= $availableQty) {
                    $updatedQty = $availableQty - $requestedQty;
                    $tmpMedicineOuts = [
                        'id' => $medicine_stock_id,
                        'qty' => $updatedQty,
                        'qty_out' => $requestedQty,
                        'medicine_id' => $medicine_id,
                        'expired_date' => $expired_date,
                        'unit_id' => $unit_id,
                        'identifier' => $medicine_id . '-' . $expired_date,
                    ];
                    array_push($medicineOuts, $tmpMedicineOuts);
                    break;
                } else {
                    $updatedQty = 0;
                    $tmpMedicineOuts = [
                        'id' => $medicine_stock_id,
                        'qty' => $updatedQty,
                        'qty_out' => $availableQty,
                        'medicine_id' => $medicine_id,
                        'expired_date' => $expired_date,
                        'unit_id' => $unit_id,
                        'identifier' => $medicine_id . '-' . $expired_date,
                    ];
                    $requestedQty = $requestedQty - $availableQty;
                    array_push($medicineOuts, $tmpMedicineOuts);
                }
            }
            $filteredMedicineStockData = array_map(function ($value) {
                return Arr::except($value, ['unit_id', 'qty_out']);
            }, $medicineOuts);
            $filteredMedicineOutsData = array_map(function ($value) {
                $arr = Arr::except($value, ['id', 'qty', 'identifier']);
                $arr['qty'] = $arr['qty_out'];
                $arr['created_at'] = Carbon::now();
                $arr['updated_at'] = Carbon::now();
                unset($arr['qty_out']);
                return $arr;
            }, $medicineOuts);
            MedicineStock::upsert($filteredMedicineStockData, ['id'], ['qty', 'identifier']);
            MedicineOut::insert($filteredMedicineOutsData);
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('internal server error...' . $e->getMessage(), 500);
        }
    }

    public function delete_cart()
    {
        DB::beginTransaction();
        try {
            $id = $this->postField('id');
            $this->transactionOutRepository->restoreMedicineStockFromCart($id);
            $this->transactionOutRepository->deleteCartItem($id);
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('internal server error', 500);
        }
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $author = Auth::id();
            $date = $this->postField('date');
            $location_id = $this->postField('location');
            $date_value = Carbon::parse($date)->format('Y-m-d');
            $batch_id = 'TO-' . date('YmdHis');
            $description = $this->postField('description') ?? '-';
            $data_request = [
                'user_id' => $author,
                'location_id' => $location_id,
                'date' => $date_value,
                'batch_id' => $batch_id,
                'description' => $description
            ];
            $transaction_out = $this->transactionOutRepository->create($data_request);
//            $carts = $this->transactionOutRepository->cart();
            $this->transactionOutRepository->setTransactionIdToCart($transaction_out->id);
            $this->transactionOutRepository->cleanZeroStock();
//            foreach ($carts as $cart) {
//                $medicine_id = $cart->medicine_id;
//                $medicine_out_id = $cart->id;
//                $qty = $cart->qty;
//                $available_stocks = $this->transactionOutRepository->getAvailableStock($medicine_id);
//                $general_ledgers = $this->generateGeneralLedger($available_stocks, $qty);
//                if ($general_ledgers['error']) {
//                    return $this->jsonResponse('failed to create general ledger', 500);
//                    break;
//                }
//                $general_ledger_data = $general_ledgers['data'];
//                foreach ($general_ledger_data as $general_ledger) {
//                    $medicine_in_id = $general_ledger['medicine_in_id'];
//                    $transaction_in_id = $general_ledger['transaction_in_id'];
//                    $g_l_qty = $general_ledger['qty'];
//                    $g_l_data = [
//                        'date' => $date_value,
//                        'medicine_in_id' => $medicine_in_id,
//                        'medicine_out_id' => $medicine_out_id,
//                        'transaction_in_id' => $transaction_in_id,
//                        'transaction_out_id' => $transaction_out->id,
//                        'qty' => $g_l_qty,
//                        'type' => 1,
//                        'description' => $description
//                    ];
//                    $this->transactionOutRepository->saveToGeneralLedger($g_l_data);
//                    $this->transactionOutRepository->updateUsedStock($medicine_in_id, $g_l_qty);
//                }
//                $this->transactionOutRepository->addOrUpdateToLocationStock($location_id, $medicine_id, $qty);
//                $this->transactionOutRepository->reduceStock($medicine_id, $qty);
//            }
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('internal server error...', 500);
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
            $transaction_in_id = $available_stock->transaction_in_id;
            if ($tmp_qty >= $tmp_rest) {
                array_push($tmp_general_ledgers, [
                    'transaction_in_id' => $transaction_in_id,
                    'medicine_in_id' => $medicine_in_id,
                    'qty' => $tmp_rest,
                    'price' => $tmp_price,
                    'total' => ($tmp_rest * $tmp_price)
                ]);
                $tmp_rest = 0;
            } else {
                $tmp_rest = $tmp_rest - $tmp_qty;
                array_push($tmp_general_ledgers, [
                    'transaction_in_id' => $transaction_in_id,
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

    public function detail($id)
    {
        $data = $this->transactionOutRepository->getTransactionOutById($id, ['medicine_outs.medicine', 'location', 'medicine_outs.unit']);
        return view('admin.pengeluaran.detailpengeluaran')->with(['data' => $data]);
    }

    public function print_transaction_out($id)
    {
        $data = $this->transactionOutRepository->getTransactionOutById($id, ['medicine_outs.medicine', 'location', 'medicine_outs.unit']);
        return $this->convertToPdf('admin.pengeluaran.suratbarangkeluar', ['data' => $data]);
    }
}
