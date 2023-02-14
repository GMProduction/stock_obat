<?php


namespace App\Repository;


use App\Models\LocationStock;

class LocationStockRepository
{
    public function __construct()
    {
    }

    public function create($data)
    {
        return LocationStock::create($data);
    }

    public function getStockByLocationIDAndMedicineID($locationID, $medicineID)
    {
        return LocationStock::with([])
            ->where('location_id', '=', $locationID)
            ->where('medicine_id', '=', $medicineID)
            ->first();
    }

    public function isExistsOnLocation($locationID, $medicineID)
    {
        return LocationStock::with([])
            ->where('location_id', '=', $locationID)
            ->where('medicine_id', '=', $medicineID)
            ->exists();
    }

    public function addOrUpdateToLocationStock($locationID, $medicineID, $qty = 0)
    {
        $item = $this->getStockByLocationIDAndMedicineID($locationID, $medicineID);
        if (!$item) {
            return LocationStock::create([
                'location_id' => $locationID,
                'medicine_id' => $medicineID,
                'qty' => $qty
            ]);
        }
        $currentQty = $item->qty;
        return $item->update([
            'qty' => ($currentQty + $qty)
        ]);
    }
}
