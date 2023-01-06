<?php

namespace App\Http\Controllers;

use App\Models\BudgetSource;
use App\Models\Unit;
use App\Repository\UnitRepository;

class MasterOtherController extends Controller
{

    /** @var UnitRepository $repo */
    private $repo;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->repo = $unitRepository;
    }

    public function datatableUnit()
    {
        $this->repo->select(['name',]);
        $this->repo->button(['edit', 'delete']);
        return $this->repo->datatabe(Unit::query());
    }

    public function datatableBudget(){
        $this->repo->select(['name',]);
        $this->repo->button(['edit', 'delete']);
        return $this->repo->datatabe(BudgetSource::query());
    }

    public function index()
    {
        return view('admin.master.masterother', ['page' => 'masterPage', 'subpage' => 'masterBarang']);
    }

    public function patch(){
        return $this->repo->patchData(Unit::class);
    }

}
