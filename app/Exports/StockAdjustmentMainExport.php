<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StockAdjustmentMainExport implements WithMultipleSheets
{
    private $data;
    private $dateStart;
    private $dateEnd;

    public function __construct($data, $dateStart, $dateEnd)
    {
        $this->data = $data;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    /**
     * @inheritDoc
     */
    public function sheets(): array
    {
        // TODO: Implement sheets() method.
        return [
            new StockAdjustmentExport($this->data, $this->dateStart, $this->dateEnd),
            new StockAdjustmentDetailExport($this->data, $this->dateStart, $this->dateEnd)
        ];
    }
}
