<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GeneralLedgerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
            ['Laporan Jurnal Umum Barang Periode ' . Carbon::parse($this->dateStart)->format('d F Y') . ' - ' . Carbon::parse($this->dateEnd)->format('d F Y')],
            [],
            ['No.',
                'Tanggal',
                'Masuk / Keluar',
                'Nama Obat',
                'Batch Masuk',
                'Batch Keluar',
                'Jumlah',
                'Keterangan',]
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
                strtoupper($value->description),
            ];
            array_push($results, $tmp);
        }
        return $results;
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }
}
