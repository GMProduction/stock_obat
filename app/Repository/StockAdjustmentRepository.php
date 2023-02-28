<?php


namespace App\Repository;


use App\Models\StockAdjustmentDetail;

class StockAdjustmentRepository
{

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
