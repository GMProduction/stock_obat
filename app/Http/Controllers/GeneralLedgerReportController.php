<?php


namespace App\Http\Controllers;


use App\Exports\GeneralLedgerExport;
use App\Helper\CustomController;
use App\Models\MedicineIn;
use App\Models\MedicineOut;
use App\Repository\GeneralLedgerRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        $medicine_ins = DB::table('medicine_ins')
            ->join('medicines', 'medicine_ins.medicine_id', '=', 'medicines.id')
            ->select([
                'medicine_ins.id as id',
                'medicine_ins.medicine_id as medicine_id',
                'medicines.name as medicine_name',
                DB::raw("0 as type")
            ])
            ->whereNotNull('transaction_in_id');

        $medicine_outs = DB::table('medicine_outs')
            ->join('medicines', 'medicine_outs.medicine_id', '=', 'medicines.id')
            ->select([
                'medicine_outs.id as id',
                'medicine_outs.medicine_id as medicine_id',
                'medicines.name as medicine_name',
                DB::raw("1 as type")
            ])
            ->whereNotNull('transaction_out_id')
            ->union($medicine_ins)
            ->get();
        return $medicine_outs->toArray();
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
