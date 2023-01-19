<?php


namespace App\Repository;


use App\Models\MedicineIn;

class MedicineInRepository
{

    public function __construct()
    {

    }

    public function create($data)
    {
        return MedicineIn::create($data);
    }

    public function deleteByID($id)
    {
        return MedicineIn::destroy($id);
    }
    /**
     * @param $medicine_id
     * @return MedicineIn | null
     */
    public function medicineOnCart($medicine_id)
    {
        return MedicineIn::where('medicine_id', '=', $medicine_id)
            ->whereNull('transaction_in_id')
            ->first();
    }

    /**
     * @param array $preload
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function cart($preload = [])
    {
        return MedicineIn::with($preload)->whereNull('transaction_in_id')->get();
    }

    public function setTransactionIdToCart($id)
    {
        return MedicineIn::whereNull('transaction_in_id')->update([
            'transaction_in_id' => $id
        ]);
    }

    public function getAvailableStock($medicine_id, $preload = [])
    {
        return MedicineIn::with($preload)
            ->where('medicine_id', '=', $medicine_id)
            ->whereRaw('(qty - used) > ?', [0])
            ->orderBy('expired_date', 'ASC')
            ->get()
            ->append('rest');
    }

    public function updateUsedStock($id, $qty = 0)
    {
        $medicine_in = MedicineIn::find($id);
        $current_used = $medicine_in->used;
        return $medicine_in->update([
            'used' => $current_used + $qty
        ]);
    }
}
