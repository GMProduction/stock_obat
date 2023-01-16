<?php


namespace App\Repository;


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
}
