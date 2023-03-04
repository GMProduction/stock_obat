<?php


namespace App\Http\Controllers;


use App\Exports\TransactionInDetailExport;
use App\Exports\TransactionInExport;
use App\Exports\TransactionInMainExport;
use App\Helper\CustomController;
use App\Models\BudgetSource;
use App\Repository\ReportRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ReportTransactionInController extends CustomController
{
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        parent::__construct();
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $date_start = Carbon::parse($this->field('date_start'))->format('Y-m-d');
            $date_end = Carbon::parse($this->field('date_end'))->format('Y-m-d');
            $budget_source_id = $this->field('budget_source');
            $preload = ['budget_source'];
            $data = $this->reportRepository->getTransactionInsData($date_start, $date_end, $budget_source_id, $preload);
            return $this->basicDataTables($data);
        }
        $budget_sources = $this->reportRepository->getAllBudgetSource();
        return view('admin.laporan.penerimaan')->with([
            'budget_sources' => $budget_sources
        ]);
    }

    public function detail($id)
    {
        try {
            $preload = ['budget_source', 'medicine_ins.medicine', 'medicine_ins.unit'];
            $data = $this->reportRepository->getTransactionInsDataByID($id, $preload);
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server...', 500);
        }
    }

    public function exportToExcel()
    {
        $date_start = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $date_end = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $budget_source_id = $this->field('budget_source');
        $preload = ['budget_source', 'medicine_ins.medicine', 'medicine_ins.unit'];
        $data = $this->reportRepository->getTransactionInsData($date_start, $date_end, $budget_source_id, $preload);
        $name = 'Transaksi-Penerimaan-' . date('YmdHis') . '.xlsx';
        return Excel::download(new TransactionInMainExport($data, $date_start, $date_end), $name);
    }

    public function printToPDF()
    {
        $date_start = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $date_end = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $budget_source_id = $this->field('budget_source');
        $preload = ['budget_source', 'medicine_ins.medicine', 'medicine_ins.unit'];
        $budget_source = 'Semua';
        if ($budget_source_id !== '') {
            $tmp_budget_source = BudgetSource::find($budget_source_id);
            $budget_source = $tmp_budget_source->name;
        }
        $data = $this->reportRepository->getTransactionInsData($date_start, $date_end, $budget_source_id, $preload);
        return $this->convertToPdf('admin.laporan.cetakpenerimaan', ['data' => $data, 'date_start' => $date_start, 'date_end' => $date_end, 'budget_source' => $budget_source, 'idx' => 1]);
    }

}
