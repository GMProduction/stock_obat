<?php


namespace App\Repository;


use App\Models\GeneralLedger;

class GeneralLedgerRepository
{

    public function create($data)
    {
        return GeneralLedger::create($data);
    }
}
