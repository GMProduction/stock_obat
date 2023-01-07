<?php

namespace App\Http\Controllers;

use App\Models\BudgetSource;
use App\Models\Unit;
use App\Repository\BudgetRepository;
use App\Repository\UnitRepository;

class MasterOtherController extends Controller
{

    /** @var UnitRepository $repo */
    private $repo;
    private $repoBudget;

    public function __construct(UnitRepository $unitRepository, BudgetRepository $budgetRepository)
    {
        $this->repo = $unitRepository;
        $this->repoBudget = $budgetRepository;
    }

    public function datatableUnit()
    {

        return $this->repo->showDatatable();
    }

    public function datatableBudget(){

        return $this->repoBudget->showDatatable();
    }

    public function index()
    {
        return view('admin.master.masterother', ['page' => 'masterPage', 'subpage' => 'masterBarang']);
    }

    public function patch($type){
        if ($type == 'unit'){
            return $this->repo->patchForm();

        }elseif ($type == 'budget'){
            return $this->repoBudget->patchForm();
        }
        return response()->json('Data not found',400);
    }

}
