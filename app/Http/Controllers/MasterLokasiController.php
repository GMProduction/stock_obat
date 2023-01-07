<?php


namespace App\Http\Controllers;



use App\Models\Location;
use App\Repository\LocationRepository;

class MasterLokasiController
{
    private $repo;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->repo = $locationRepository;
    }

    public function datatable(){
        return $this->repo->showDatatable();
    }

    public function index()
    {
        if (request()->method() == 'POST'){
            return $this->patchData();
        }
        return view('admin.master.masterlokasi', ['page' => 'masterPage', 'subpage' => 'masterLokasi']);
    }

    public function patchData(){
        return $this->repo->patchForm();
    }


}
