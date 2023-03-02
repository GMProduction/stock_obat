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
        $adjustment = DB::table('stock_adjustment_details');


        if ($type === '0') {
            $adjustment->join('medicines', 'stock_adjustment_details.medicine_id', '=', 'medicines.id')
                ->join('stock_adjustments', 'stock_adjustment_details.stock_adjustment_id', '=', 'stock_adjustments.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'stock_adjustment_details.id as id',
                    'stock_adjustments.date as date',
                    'stock_adjustment_details.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'stock_adjustment_details.expired_date as expired_date',
                    DB::raw('ABS(stock_adjustment_details.real_qty - stock_adjustment_details.current_qty) as qty'),
                    'stock_adjustments.description as description',
                    DB::raw('0 as type')
                ])
                ->whereNotNull('stock_adjustment_id')
                ->whereRaw('(stock_adjustment_details.real_qty - stock_adjustment_details.current_qty) > 0');

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
                $adjustment->whereBetween('stock_adjustments.date', [$startDate, $endDate]);
            }
            return $medicine_ins->union($adjustment)->orderBy('date', 'ASC')->orderBy('id', 'ASC')->get();
        } elseif ($type === '1') {
            $adjustment->join('medicines', 'stock_adjustment_details.medicine_id', '=', 'medicines.id')
                ->join('stock_adjustments', 'stock_adjustment_details.stock_adjustment_id', '=', 'stock_adjustments.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'stock_adjustment_details.id as id',
                    'stock_adjustments.date as date',
                    'stock_adjustment_details.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'stock_adjustment_details.expired_date as expired_date',
                    DB::raw('ABS(stock_adjustment_details.real_qty - stock_adjustment_details.current_qty) as qty'),
                    'stock_adjustments.description as description',
                    DB::raw('1 as type')
                ])
                ->whereNotNull('stock_adjustment_id')
                ->whereRaw('(stock_adjustment_details.real_qty - stock_adjustment_details.current_qty) < 0');

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
                $adjustment->whereBetween('stock_adjustments.date', [$startDate, $endDate]);
            }
            return $medicine_outs->union($adjustment)->orderBy('date', 'ASC')->orderBy('id', 'ASC')->get();
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

            $adjustment->join('medicines', 'stock_adjustment_details.medicine_id', '=', 'medicines.id')
                ->join('stock_adjustments', 'stock_adjustment_details.stock_adjustment_id', '=', 'stock_adjustments.id')
                ->join('units', 'medicines.unit_id', '=', 'units.id')
                ->select([
                    'stock_adjustment_details.id as id',
                    'stock_adjustments.date as date',
                    'stock_adjustment_details.medicine_id as medicine_id',
                    'medicines.name as medicine_name',
                    'units.name as unit',
                    'stock_adjustment_details.expired_date as expired_date',
                    DB::raw('ABS(stock_adjustment_details.real_qty - stock_adjustment_details.current_qty) as qty'),
                    'stock_adjustments.description as description',
                    DB::raw('IF((stock_adjustment_details.real_qty - stock_adjustment_details.current_qty) < 0, 1, 0) as type')
                ])
                ->whereNotNull('stock_adjustment_id');

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
                $medicine_outs->whereBetween('transaction_outs.date', [$startDate, $endDate]);
                $medicine_ins->whereBetween('transaction_ins.date', [$startDate, $endDate]);
                $adjustment->whereBetween('stock_adjustments.date', [$startDate, $endDate]);
            }
            return $medicine_ins->union($medicine_outs)->union($adjustment)
                ->orderBy('date', 'ASC')
                ->orderBy('id', 'ASC')
                ->get();
        }
    }
}
