<?php


namespace App\Http\Controllers;


use App\Exports\GeneralLedgerExport;
use App\Exports\StockExport;
use App\Helper\CustomController;
use App\Models\Location;
use App\Models\Medicine;
use App\Repository\MedicineRepository;
use Maatwebsite\Excel\Facades\Excel;

class StockReportController extends CustomController
{
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepository)
    {
        parent::__construct();
        $this->medicineRepository = $medicineRepository;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $locationID = strtolower($this->field('location'));
            try {
                $data = $this->medicineRepository->getMedicinesReportStockByLocation($locationID);
                return $this->basicDataTables($data);
            } catch (\Exception $e) {
                return $this->basicDataTables([]);
            }
        }
        $locations = Location::all();
        return view('admin.laporan.stock')->with(['locations' => $locations]);
    }

    public function exportToExcel()
    {
        $locationID = strtolower($this->field('location'));
        $data = $this->medicineRepository->getMedicinesReportStockByLocation($locationID);
        $name = 'stock-' . date('YmdHis') . '.xlsx';
        return Excel::download(new StockExport($data), $name);
    }

    public function printToPDF()
    {
        $locationID = strtolower($this->field('location'));
        $data = $this->medicineRepository->getMedicinesReportStockByLocation($locationID);
        return $this->convertToPdf('admin.laporan.cetak-stock', ['data' => $data]);
    }
}
