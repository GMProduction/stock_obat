<?php

namespace App\Repository;

use App\Models\Unit;

class UnitRepository extends BaseRepo
{

    public function __construct()
    {
        $this->class = 'Unit';
        $this->selectData = ['name'];
        $this->button = ['edit'];
    }

    public function patchForm()
    {
        return $this->patchData(Unit::class);
    }

    public function showDatatable()
    {
        return $this->datatabe(Unit::query());
    }

    public function getAll()
    {
        return Unit::all();
    }

}
