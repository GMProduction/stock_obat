<?php


namespace App\Http\Controllers;


use App\Exports\GeneralLedgerExport;
use App\Helper\CustomController;
use App\Repository\GeneralLedgerRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class GeneralLedgerReportController extends CustomController
{
    private $generalLedgerRepository;

    public function __construct(GeneralLedgerRepository $generalLedgerRepository)
    {
        parent::__construct();
        $this->generalLedgerRepository = $generalLedgerRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = $this->getGeneralLedgerData();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.jurnalbarang');
    }

    public function excel()
    {
        $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $data = $this->getGeneralLedgerData();
        $name = 'jurnal-umum-' . date('YmdHis') . '.xlsx';
        return Excel::download(new GeneralLedgerExport($data, $startDate, $endDate), $name);
    }

    public function printToPDF()
    {
        $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $type = strtolower($this->field('type'));
        $data = $this->getGeneralLedgerData();
        $html = view('admin.laporan.cetak-jurnal')->with(['startDate' => $startDate, 'endDate' => $endDate, 'data' => $data, 'type' => $type]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    private function getGeneralLedgerData()
    {
        $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
        $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
        $type = $this->field('type');
        $preload = ['medicine_in.medicine', 'medicine_out.medicine', 'transaction_in', 'transaction_out'];
        return $this->generalLedgerRepository->getDataByPeriodic($startDate, $endDate, $preload, $type);
    }
}
