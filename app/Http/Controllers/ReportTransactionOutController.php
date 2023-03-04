<?php


namespace App\Http\Controllers;


use App\Exports\TransactionInMainExport;
use App\Exports\TransactionOutExport;
use App\Exports\TransactionOutMainExport;
use App\Helper\CustomController;
use App\Models\Location;
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

    public function detail($id)
    {
        try {
            $preload = ['location', 'medicine_outs.medicine', 'medicine_outs.unit'];
            $data = $this->reportRepository->getTransactionOutsDataByID($id, $preload);
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server...', 500);
        }
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

    public function printToPDF()
    {
        $date_start = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $date_end = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $location_id = $this->field('location');
        $location = 'Semua';
        if ($location_id !== '') {
            $tmp_location = Location::find($location_id);
            $location = $tmp_location->name;
        }
        $preload = ['location', 'medicine_outs.medicine', 'medicine_outs.unit'];
        $data = $this->reportRepository->getTransactionOutsData($date_start, $date_end, $location_id, $preload);
        return $this->convertToPdf('admin.laporan.cetakbarangkeluar', ['data' => $data, 'date_start' => $date_start, 'date_end' => $date_end, 'location' => $location, 'idx' => 1]);
    }
}
