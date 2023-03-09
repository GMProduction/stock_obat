<?php

namespace App\Repository;

use App\Models\Location;

class LocationRepository extends BaseRepo
{
    public function __construct()
    {
        $this->selectData = ['name'];
        $this->button = ['edit'];
    }

    public function patchForm()
    {
        return $this->patchData(Location::class);
    }

    public function showDatatable()
    {
        return $this->datatabe(Location::query());
    }

    public function findAll($preload = [])
    {
        return Location::with($preload)->get();
    }
}
