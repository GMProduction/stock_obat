<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Repository\GeneralLedgerRepository;
use Carbon\Carbon;

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
            $startDate = Carbon::parse($this->field('date_start'))->format('Y-m-d');
            $endDate = Carbon::parse($this->field('date_end'))->format('Y-m-d');
//            dd($startDate, $endDate);
            $preload = ['medicine_in.medicine', 'medicine_out.medicine', 'transaction_in', 'transaction_out'];
            $data = $this->generalLedgerRepository->getDataByPeriodic($startDate, $endDate, $preload);
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.jurnalbarang');
    }
}
