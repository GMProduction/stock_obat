<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class StockExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStrictNullComparison
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
        return new Collection($this->getRowData());
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        // TODO: Implement headings() method.
        return $this->generateHeadings();
    }

    public function generateHeadings()
    {
        return [
            'No.',
            'Kategori',
            'Nama Barang',
            'Satuan',
            'Jumlah',
        ];
    }

    public function getRowData()
    {
        $results = [];
        foreach ($this->data as $key => $value) {
            $tmp = [
                ($key + 1),
                $value['category'],
                $value['name'],
                $value['unit'],
                $value['qty'],
            ];
            array_push($results, $tmp);
        }
        return $results;
    }
}
