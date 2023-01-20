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

    public function getData($preload = ['user', 'budget_source'])
    {
        return TransactionIn::with($preload)
            ->orderBy('date', 'DESC')
            ->get()->append('total');
    }

    public function create($data)
    {
        return TransactionIn::create($data);
    }

    public function getTransactionInById($id, $preload = [])
    {
        return TransactionIn::with($preload)->find($id)->append('total');
    }

    public function medicineById($id)
    {
        return $this->medicineRepository->findById($id);
    }

    public function addToCart($data)
    {
        return $this->medicineInRepository->create($data);
    }

    public function deleteCartItem($id)
    {
        return $this->medicineInRepository->deleteByID($id);
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
    public function addStock($medicine_id, $addedStock = 0)
    {
        return $this->medicineRepository->addStock($medicine_id, $addedStock);
    }

    public function reduceStock($medicine_id, $minusStock = 0)
    {

    }

    public function saveToGeneralLedger($data)
    {
        return $this->generalLedgerRepository->create($data);
    }
}
