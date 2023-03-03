<?php


namespace App\Http\Controllers;


use App\Exports\StockAdjustmentExport;
use App\Exports\StockAdjustmentMainExport;
use App\Helper\CustomController;
use App\Repository\StockAdjustmentRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportAdjustmentController extends CustomController
{
    private $stockAdjustmentRepository;

    public function __construct(StockAdjustmentRepository $stockAdjustmentRepository)
    {
        parent::__construct();
        $this->stockAdjustmentRepository = $stockAdjustmentRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = $this->getStockAdjustmentData();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.adjustment');
    }

    public function excel()
    {
        $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $preload = ['details.medicine.unit'];
        $data = $this->stockAdjustmentRepository->getAdjustmentDataByPeriodic($startDate, $endDate, $preload);
        $name = 'penyesuaian-' . date('YmdHis') . '.xlsx';
        return Excel::download(new StockAdjustmentMainExport($data, $startDate, $endDate), $name);
    }

    public function printToPDF()
    {

        $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $preload = ['details.medicine.unit'];
        $data = $this->stockAdjustmentRepository->getAdjustmentDataByPeriodic($startDate, $endDate, $preload);
        return $this->convertToPdf('admin.laporan.cetak-adjustment', ['data' => $data, 'date_start' => $startDate, 'date_end' => $endDate,]);
    }

    private function getStockAdjustmentData()
    {
        $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $preload = ['details.medicine'];
        return $this->stockAdjustmentRepository->getAdjustmentDataByPeriodic($startDate, $endDate, $preload);
    }

}
