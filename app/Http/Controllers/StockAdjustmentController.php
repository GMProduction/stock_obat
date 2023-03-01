<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\MedicineStock;
use App\Models\StockAdjustment;
use App\Models\StockAdjustmentDetail;
use App\Repository\MedicineRepository;
use App\Repository\MedicineStockRepository;
use App\Repository\StockAdjustmentRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StockAdjustmentController extends CustomController
{
    private $medicineRepository;
    private $medicineStockRepository;
    private $stockAdjustmentRepository;

    public function __construct(MedicineRepository $medicineRepository, MedicineStockRepository $medicineStockRepository, StockAdjustmentRepository $stockAdjustmentRepository)
    {
        parent::__construct();
        $this->medicineRepository = $medicineRepository;
        $this->medicineStockRepository = $medicineStockRepository;
        $this->stockAdjustmentRepository = $stockAdjustmentRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $preload = [];
            $data = $this->stockAdjustmentRepository->getAdjustmentData($preload);
            return $this->basicDataTables($data);
        }
        return view('admin.penyesuaian.penyesuaian');
    }

    public function add()
    {
        if ($this->request->ajax()) {
            $preload = ['medicine.unit'];
            $data = $this->stockAdjustmentRepository->getAdjustmentDetailData($preload);
            return $this->basicDataTables($data);
        }

        if ($this->request->method() === 'POST') {
            return $this->saveAdjustment();
        }
        $medicines = $this->medicineRepository->findAll(['unit']);
        return view('admin.penyesuaian.add')->with(['medicines' => $medicines]);
    }

    public function stock()
    {
        if ($this->request->method() === 'POST') {
            return $this->storeAdjustment();
        }
        try {
            $medicineId = $this->field('medicine');
            $data = $this->medicineStockRepository->getMedicineStockByMedicine($medicineId);
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error...', 500);
        }
    }

    private function storeAdjustment()
    {
        DB::beginTransaction();
        try {
            $request = $this->postField('data');
            $arrayRequest = json_decode($request, true);
            $medicineId = $arrayRequest['medicine_id'];
            $adjustmentData = $arrayRequest['adjustment'];
            foreach ($adjustmentData as $adjustmentDatum) {
                $data_store = [
                    'medicine_id' => $medicineId,
                    'expired_date' => $adjustmentDatum[0],
                    'current_qty' => $adjustmentDatum[1],
                    'real_qty' => $adjustmentDatum[2],
                    'description' => $adjustmentDatum[3],
                ];
                $this->stockAdjustmentRepository->storeAdjustmentDetail($data_store);
            }
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('internal server error...', 500);
        }
    }

    private function saveAdjustment()
    {
        DB::beginTransaction();
        try {
            $batch_id = 'TI-' . date('YmdHis');
            $date = $this->postField('date');
            $date_value = Carbon::parse($date)->format('Y-m-d');
            $description = $this->postField('description') ?? '-';
            $preload = ['medicine.unit'];
            $adjustmentDetailData = $this->stockAdjustmentRepository->getAdjustmentDetailData($preload);
            $filteredAdjustmentDetailData = array_map(function ($value) {
                $arr['identifier'] = $value['medicine_id'] . '-' . $value['expired_date'];
                $arr['medicine_id'] = $value['medicine_id'];
                $arr['expired_date'] = $value['expired_date'];
                $arr['qty'] = $value['real_qty'];
                $arr['created_at'] = Carbon::now();
                $arr['updated_at'] = Carbon::now();
                return $arr;
            }, $adjustmentDetailData->toArray());
            $data_request = [
                'date' => $date_value,
                'batch_id' => $batch_id,
                'description' => $description
            ];
            $stockAdjustment = StockAdjustment::create($data_request);
            StockAdjustmentDetail::with([])
                ->whereNull('stock_adjustment_id')
                ->update([
                    'stock_adjustment_id' => $stockAdjustment->id
                ]);
            MedicineStock::upsert($filteredAdjustmentDetailData, ['identifier'], ['qty']);
            DB::commit();
            return redirect()->route('penyesuaian')->with('success', 'Berhasil menambahkan data...');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Terjadi kesalahan server...' . $e->getMessage());
        }
    }
}
