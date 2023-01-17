<?php


namespace App\Repository;


use App\Models\TransactionOut;

class TransactionOutRepository
{
    private $medicineRepository;
    private $medicineInRepository;
    private $medicineOutRepository;

    public function __construct(MedicineOutRepository $medicineOutRepository, MedicineRepository $medicineRepository, MedicineInRepository $medicineInRepository)
    {
        $this->medicineOutRepository = $medicineOutRepository;
        $this->medicineRepository = $medicineRepository;
        $this->medicineInRepository = $medicineInRepository;
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

}
