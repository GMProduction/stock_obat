<?php


namespace App\Repository;


use App\Models\TransactionIn;
use App\Models\TransactionOut;

class ReportRepository
{
    private $budgetSourceRepository;
    private $locationRepository;


    public function __construct(BudgetRepository $budgetSourceRepository, LocationRepository $locationRepository)
    {
        $this->budgetSourceRepository = $budgetSourceRepository;
        $this->locationRepository = $locationRepository;

    }

    public function getTransactionInsData($date_start, $date_end, $budget_source_id = '', $preload = [])
    {
        $query = TransactionIn::with($preload)
            ->whereBetween('date', [$date_start, $date_end]);
        if ($budget_source_id !== '') {
            $query->where('budget_source_id', '=', $budget_source_id);
        }
        return $query->get()->append(['total']);

    }

    public function getTransactionInsDataByID($transactionInID, $preload = [])
    {
        return TransactionIn::with($preload)
            ->where('id', '=', $transactionInID)
            ->first()->append(['total']);
    }

    public function getAllBudgetSource()
    {
        return $this->budgetSourceRepository->getAll();
    }

    public function getAllLocationRepository($preload = [])
    {
        return $this->locationRepository->findAll($preload);
    }

    public function getTransactionOutsData($date_start, $date_end, $location_id = '', $preload = [])
    {
        $query = TransactionOut::with($preload)
            ->whereBetween('date', [$date_start, $date_end]);
        if ($location_id !== '') {
            $query->where('location_id', '=', $location_id);
        }
        return $query->get();
    }

    public function getTransactionOutsDataByID($transactionOutID, $preload = [])
    {
        return TransactionOut::with($preload)
            ->where('id', '=', $transactionOutID)
            ->first();
    }
}
