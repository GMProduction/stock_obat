<?php


namespace App\Repository;


use App\Models\GeneralLedger;
use Illuminate\Support\Facades\DB;

class GeneralLedgerRepository
{

    public function create($data)
    {
        return GeneralLedger::create($data);
    }

    public function getDataByPeriodic($startDate = '', $endDate = '', $preload = [], $type = 'all')
    {
        $data = GeneralLedger::with($preload);
        if ($startDate !== '' && $endDate !== '') {
            $data->whereBetween('date', [$startDate, $endDate]);
        }

        if ($type !== 'all') {
            $data->where('type', '=', $type);
        }
        return $data->orderBy('date', 'ASC')->get();
    }

    public function getDataGeneralLedgerByPeriodic($startDate = '', $endDate = '', $type = 'all')
    {
        $medicine_outs = DB::table('medicine_outs');
        $medicine_ins = DB::table('medicine_ins');



        if ($type === '0') {
            $medicine_ins->join('medicines', 'medicine_ins.medicine_id', '=', 'medicines.id')
                ->join('transaction_ins', 'medicine_ins.transaction_in_id', '=', 'transaction_ins.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'medicine_ins.id as id',
                    'transaction_ins.date as date',
                    'medicine_ins.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'medicine_ins.expired_date as expired_date',
                    'medicine_ins.qty as qty',
                    'transaction_ins.description as description',
                    DB::raw("0 as type")
                ])->whereNotNull('transaction_in_id');
            if ($startDate !== '' && $endDate !== '') {
                $medicine_ins->whereBetween('transaction_ins.date', [$startDate, $endDate]);
            }
            return $medicine_ins->orderBy('date', 'ASC')->orderBy('id', 'ASC')->get();
        } elseif ($type === '1') {
            $medicine_outs->join('medicines', 'medicine_outs.medicine_id', '=', 'medicines.id')
                ->join('transaction_outs', 'medicine_outs.transaction_out_id', '=', 'transaction_outs.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'medicine_outs.id as id',
                    'transaction_outs.date as date',
                    'medicine_outs.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'medicine_outs.expired_date as expired_date',
                    'medicine_outs.qty as qty',
                    'transaction_outs.description as description',
                    DB::raw("1 as type")
                ])->whereNotNull('transaction_out_id');
            if ($startDate !== '' && $endDate !== '') {
                $medicine_outs->whereBetween('transaction_outs.date', [$startDate, $endDate]);
            }
            return $medicine_outs->orderBy('date', 'ASC')->orderBy('id', 'ASC')->get();
        } else {
            $medicine_outs->join('medicines', 'medicine_outs.medicine_id', '=', 'medicines.id')
                ->join('transaction_outs', 'medicine_outs.transaction_out_id', '=', 'transaction_outs.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'medicine_outs.id as id',
                    'transaction_outs.date as date',
                    'medicine_outs.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'medicine_outs.expired_date as expired_date',
                    'medicine_outs.qty as qty',
                    'transaction_outs.description as description',
                    DB::raw("1 as type")
                ])->whereNotNull('transaction_out_id');

            $medicine_ins->join('medicines', 'medicine_ins.medicine_id', '=', 'medicines.id')
                ->join('transaction_ins', 'medicine_ins.transaction_in_id', '=', 'transaction_ins.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'medicine_ins.id as id',
                    'transaction_ins.date as date',
                    'medicine_ins.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'medicine_ins.expired_date as expired_date',
                    'medicine_ins.qty as qty',
                    'transaction_ins.description as description',
                    DB::raw("0 as type")
                ])->whereNotNull('transaction_in_id');

            if ($startDate !== '' && $endDate !== '') {
                $medicine_outs->whereBetween('date', [$startDate, $endDate]);
                $medicine_ins->whereBetween('date', [$startDate, $endDate]);
            }
            return $medicine_ins->union($medicine_outs)
                ->orderBy('date', 'ASC')
                ->orderBy('id', 'ASC')
                ->get();
        }
    }
}
