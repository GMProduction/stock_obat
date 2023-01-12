<?php


namespace App\Repository;


use App\Models\Medicine;
use App\Models\MedicineIn;

class MedicineInRepository
{

    public function __construct()
    {

    }

    public function addStock($medicine_id, $addedStock = 0)
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::find($medicine_id);
        $qty = $medicine->qty;
        $new_qty = $addedStock + $qty;
        return $medicine->update([
            'qty' => $new_qty
        ]);
    }

}
