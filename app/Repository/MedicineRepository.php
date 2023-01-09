<?php

namespace App\Repository;

use App\Models\Medicine;

class MedicineRepository extends BaseRepo
{
    public function __construct()
    {
    }

    public function showDatatable(){
        $data = Medicine::with(['category:id,name','unit:id,name'])->select();
        $this->selectData = ['name','unit_id','limit', 'category_id'];
        $this->button = ['edit', 'delete'];
        return $this->datatabe($data);

    }

}
