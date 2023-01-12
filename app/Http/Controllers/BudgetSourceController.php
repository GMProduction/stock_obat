<?php

namespace App\Http\Controllers;

use App\Repository\BudgetRepository;

class BudgetSourceController extends Controller
{
    private $repo;

    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->repo = $budgetRepository;
    }

    public function getJson(){
        return $this->repo->getAll();
    }


}
