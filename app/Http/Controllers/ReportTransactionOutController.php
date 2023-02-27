<?php


namespace App\Http\Controllers;


use App\Exports\TransactionInMainExport;
use App\Exports\TransactionOutExport;
use App\Exports\TransactionOutMainExport;
use App\Helper\CustomController;
use App\Repository\ReportRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportTransactionOutController extends CustomController
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
            $location_id = $this->field('location');
            $preload = ['location'];
            $data = $this->reportRepository->getTransactionOutsData($date_start, $date_end, $location_id, $preload);
            return $this->basicDataTables($data);
        }
        $locations = $this->reportRepository->getAllLocationRepository();
        return view('admin.laporan.barangkeluar')->with(['locations' => $locations]);
    }

    public function exportToExcel()
    {
        $date_start = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $date_end = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $location_id = $this->field('location');
        $preload = ['location', 'medicine_outs.medicine', 'medicine_outs.unit'];
        $data = $this->reportRepository->getTransactionOutsData($date_start, $date_end, $location_id, $preload);
        $name = 'Transaksi-Distribusi-obat-' . date('YmdHis') . '.xlsx';
        return Excel::download(new TransactionOutMainExport($data, $date_start, $date_end), $name);
    }
}
