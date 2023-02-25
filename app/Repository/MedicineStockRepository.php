<?php


namespace App\Repository;


use App\Models\MedicineStock;

class MedicineStockRepository
{

    public function addMedicineStock($medicine_id, $expired_date, $qty, $preload = [])
    {
        $medicine_stock = MedicineStock::with($preload)
            ->where('medicine_id', '=', $medicine_id)
            ->where('expired_date', '=', $expired_date)
            ->first();
        if (!$medicine_stock) {
            $data = [
                'medicine_id' => $medicine_id,
                'expired_date' => $expired_date,
                'qty' => $qty
            ];
            return MedicineStock::create($data);
        }
        $current_qty = $medicine_stock->qty;
        return $medicine_stock->update([
            'qty' => ($current_qty + $qty)
        ]);
    }
}
