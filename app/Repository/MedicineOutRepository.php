<?php


namespace App\Repository;


use App\Models\MedicineOut;

class MedicineOutRepository
{

    public function create($data)
    {
        return MedicineOut::create($data);
    }

    public function deleteByID($id)
    {
        return MedicineOut::destroy($id);
    }

    public function medicineOnCart($medicine_id, $preload = [])
    {
        return MedicineOut::with($preload)
            ->where('medicine_id', '=', $medicine_id)
            ->whereNull('transaction_out_id')
            ->first();
    }

    public function cart($preload = [])
    {
        return MedicineOut::with($preload)->whereNull('transaction_out_id')->get();
    }

    public function setTransactionIdToCart($id)
    {
        return MedicineOut::whereNull('transaction_out_id')->update([
            'transaction_out_id' => $id
        ]);
    }
}
