<?php


namespace App\Repository;


use App\Models\GeneralLedger;

class GeneralLedgerRepository
{

    public function create($data)
    {
        return GeneralLedger::create($data);
    }

    public function getDataByPeriodic($startDate = '', $endDate = '', $preload = [])
    {
        $data = GeneralLedger::with($preload);
        if ($startDate !== '' && $endDate !== '') {
            $data->whereBetween('date', [$startDate, $endDate]);
        }
        return $data->orderBy('date', 'ASC')->get();
    }
}
