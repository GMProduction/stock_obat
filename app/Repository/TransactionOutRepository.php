<?php


namespace App\Repository;


use App\Models\TransactionOut;

class TransactionOutRepository
{
    private $medicineRepository;
    private $medicineInRepository;
    private $medicineOutRepository;
    private $generalLedgerRepository;

    public function __construct(MedicineOutRepository $medicineOutRepository, MedicineRepository $medicineRepository, MedicineInRepository $medicineInRepository, GeneralLedgerRepository $generalLedgerRepository)
    {
        $this->medicineOutRepository = $medicineOutRepository;
        $this->medicineRepository = $medicineRepository;
        $this->medicineInRepository = $medicineInRepository;
        $this->generalLedgerRepository = $generalLedgerRepository;
    }

    public function create($data)
    {
        return TransactionOut::create($data);
    }

    public function getData($preload = [])
    {
        return TransactionOut::with($preload)
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function findMedicineByID($medicine_id, $preload = [])
    {
        return $this->medicineRepository->findById($medicine_id);
    }

    public function getAvailableStock($medicine_id, $preload = [])
    {
        return $this->medicineInRepository->getAvailableStock($medicine_id, $preload);
    }

    public function addToCart($data)
    {
        return $this->medicineOutRepository->create($data);
    }

    public function deleteCartItem($id)
    {
        return $this->medicineOutRepository->deleteByID($id);
    }

    public function cart($preload = [])
    {
        return $this->medicineOutRepository->cart($preload);
    }

    public function setTransactionIdToCart($id)
    {
        return $this->medicineOutRepository->setTransactionIdToCart($id);
    }

    public function saveToGeneralLedger($data)
    {
        return $this->generalLedgerRepository->create($data);
    }

    public function updateUsedStock($id, $qty = 0)
    {
        return $this->medicineInRepository->updateUsedStock($id, $qty);
    }

    public function reduceStock($medicine_id, $minusStock)
    {
        return $this->medicineRepository->reduceStock($medicine_id, $minusStock);
    }
}
