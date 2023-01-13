<?php


namespace App\Http\Controllers;



use App\Repository\MedicineRepository;

class MasterController
{
    private $repo;

    public function __construct(MedicineRepository $medicineRepository)
    {
        $this->repo = $medicineRepository;
    }

    public function index()
    {
        if (request()->method() == 'POST'){
            return $this->repo->patchForm();
        }
        return view('admin.master.master', ['page' => 'masterPage', 'subpage' => 'masterBarang']);
    }

    public function datatable(){
        return $this->repo->showDatatable();
    }


}
