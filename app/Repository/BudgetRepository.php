<?php

namespace App\Repository;

use App\Helper\CustomController;
use App\Models\BudgetSource;

class BudgetRepository extends BaseRepo
{
    public function __construct()
    {
        $this->selectData = ['name'];
        $this->button = ['edit', 'delete'];
    }

    public function patchForm(){
        return $this->patchData(BudgetSource::class);
    }

    public function showDatatable(){
        return $this->datatabe(BudgetSource::query());
    }

    public function getAll(){
        return BudgetSource::all();
    }


}
