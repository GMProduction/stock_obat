<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StockMainExport implements WithMultipleSheets
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function sheets(): array
    {
        // TODO: Implement sheets() method.
        return [
            new StockExport($this->data),
            new StockDetailExport($this->data)
        ];
    }
}
