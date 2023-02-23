<?php


namespace App\Http\Controllers;

use App\Exports\GeneralLedgerExport;
use App\Helper\CustomController;
use App\Models\Location;
use App\Models\Medicine;
use App\Repository\GeneralLedgerRepository;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;


class PenyesuaianController extends CustomController
{


    // PENYESUAIAN
    public function penyesuaian()
    {
        return view('admin.penyesuaian.penyesuaian');
    }

    // PENYESUAIAN
    public function tambahpenyesuaian()
    {
        return view('admin.penyesuaian.tambahpenyesuaian');
    }
}
