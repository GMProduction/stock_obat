<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStrictNullComparison, WithStyles, WithTitle
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
        $currentDate = Carbon::now()->format('d F Y');
        return [
            ['Laporan Stock Obat Per Tanggal ' . $currentDate],
            [],
            [
                'No.',
                'Kategori',
                'Nama Barang',
                'Satuan',
                'Jumlah',
                'Indikator Kadaluarsa',
                'Indikator Peringatan Jumlah',
            ]
        ];
    }

    public function getRowData()
    {
        $results = [];
        foreach ($this->data as $key => $value) {
            $tmp = [
                ($key + 1),
                $value->category->name,
                $value->name,
                $value->unit->name,
                $value->stock,
                $value->expiration.' bulan',
                $value->stock <= $value->limit ? '!' : '',
            ];
            array_push($results, $tmp);
        }
        return $results;
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Stock Obat';
    }
}
