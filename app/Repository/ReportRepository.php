<?php


namespace App\Repository;


use App\Models\TransactionIn;

class ReportRepository
{
    private $budgetSourceRepository;

    public function __construct(BudgetRepository $budgetSourceRepository)
    {
        $this->budgetSourceRepository = $budgetSourceRepository;
    }

    public function getTransactionInsData($date_start, $date_end, $budget_source_id = '', $preload = [])
    {
        $query = TransactionIn::with($preload)
            ->whereBetween('date', [$date_start, $date_end]);
        if ($budget_source_id !== '') {
            $query->where('budget_source_id', '=', $budget_source_id);
        }
        return $query->get();

    }

    public function getAllBudgetSource()
    {
        return $this->budgetSourceRepository->getAll();
    }
}
