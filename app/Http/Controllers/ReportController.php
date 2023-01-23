<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\BudgetSource;
use App\Repository\ReportRepository;

class ReportController extends CustomController
{
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        parent::__construct();
        $this->reportRepository = $reportRepository;
    }

    public function transaction_ins_index()
    {
        if ($this->request->ajax()) {
            $date_start = $this->field('date_start');
            $date_end = $this->field('date_end');
            $budget_source_id = $this->field('budget_source');
            $data = $this->reportRepository->getTransactionInsData($date_start, $date_end, $budget_source_id, []);
            return $this->basicDataTables($data);
        }
        $budget_sources = $this->reportRepository->getAllBudgetSource();
        return view('admin.laporan.penerimaan')->with([
            'budget_sources' => $budget_sources
        ]);
    }
}
