<?php

namespace App\Repository;

use App\Models\Unit;

class UnitRepository extends BaseRepo
{

    public function __construct()
    {
        $this->class = 'Unit';
        $this->selectData = ['name'];
        $this->button = ['edit', 'delete'];
    }

    public function patchForm(){
        return $this->patchData(Unit::class);
    }

    public function showDatatable(){
        return $this->datatabe(Unit::query());
    }

}
