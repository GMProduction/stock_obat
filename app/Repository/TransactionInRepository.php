<?php


namespace App\Repository;


use App\Models\Medicine;
use App\Models\MedicineIn;

class TransactionInRepository
{
    private $medicineRepository;

    public function __construct(MedicineInRepository $medicineInRepository)
    {
        $this->medicineRepository = $medicineInRepository;
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function cart()
    {
        return MedicineIn::whereNull('transaction_in_id')->get();
    }

    public function patchStock($medicine_id, $addedStock = 0)
    {
        return $this->medicineRepository->addStock($medicine_id, $addedStock);
    }
}
