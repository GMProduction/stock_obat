<?php


namespace App\Repository;


use App\Models\TransactionIn;

class TransactionInRepository
{
    private $medicineRepository;
    private $medicineInRepository;
    private $generalLedgerRepository;

    public function __construct(MedicineRepository $medicineRepository, MedicineInRepository $medicineInRepository, GeneralLedgerRepository $generalLedgerRepository)
    {
        $this->medicineRepository = $medicineRepository;
        $this->medicineInRepository = $medicineInRepository;
        $this->generalLedgerRepository = $generalLedgerRepository;
    }

    public function getData()
    {
        return TransactionIn::with(['user', 'budget_source'])
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function create($data)
    {
        return TransactionIn::create($data);
    }

    public function medicineById($id)
    {
        return $this->medicineRepository->findById($id);
    }

    public function addToCart($data)
    {
        return $this->medicineInRepository->create($data);
    }

    public function setTransactionIdToCart($id)
    {
        return $this->medicineInRepository->setTransactionIdToCart($id);
    }

    /**
     * @param $medicine_id
     * @return \App\Models\MedicineIn|null
     */
    public function medicineOnCart($medicine_id)
    {
        return $this->medicineInRepository->medicineOnCart($medicine_id);
    }

    /**
     * @param array $preload
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function cart($preload = [])
    {
        return $this->medicineInRepository->cart($preload);
    }

    /**
     * @param $medicine_id
     * @param int $addedStock
     * @return bool
     */
    public function patchStock($medicine_id, $addedStock = 0)
    {
        return $this->medicineRepository->addStock($medicine_id, $addedStock);
    }

    public function saveToGeneralLedger($data)
    {
        return $this->generalLedgerRepository->create($data);
    }
}
