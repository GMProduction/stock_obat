<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneralLedgerExport implements FromCollection, WithHeadings, ShouldAutoSize
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
            'Tanggal',
            'Masuk / Keluar',
            'Nama Obat',
            'Batch Masuk',
            'Batch Keluar',
            'Jumlah',
            'Keterangan',
        ];
    }

    public function getRowData()
    {
        $results = [];
        foreach ($this->data as $key => $value) {
            $date = $value->date;
            $type = $value->type === 0 ? 'Masuk' : 'Keluar';
            $medicineName = '-';
            if ($value->type === 0) {
                $medicineName = $value->medicine_in->medicine->name;
            } else {
                $medicineName = $value->medicine_out->medicine->name;
            }

            $batchIn = $value->transaction_in->batch_id;

            $batchOut = '-';
            if ($value->type === 1) {
                $batchOut = $value->transaction_out->batch_id;
            }
            $tmp = [
                ($key + 1),
                $date,
                $type,
                $medicineName,
                $batchIn,
                $batchOut,
                $value->qty,
                $value->description,
            ];
            array_push($results, $tmp);
        }
        return $results;
    }
}
