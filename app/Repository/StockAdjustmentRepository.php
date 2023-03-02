<?php


namespace App\Repository;


use App\Models\StockAdjustment;
use App\Models\StockAdjustmentDetail;

class StockAdjustmentRepository
{

    public function getAdjustmentData($preload = [])
    {
        return StockAdjustment::with($preload)
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function storeAdjustmentDetail($data)
    {
        return StockAdjustmentDetail::create($data);
    }

    public function getAdjustmentDetailData($preload = [])
    {
        return StockAdjustmentDetail::with($preload)
            ->whereNull('stock_adjustment_id')
            ->get();
    }
}
