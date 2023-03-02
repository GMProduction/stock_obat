<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionOutDetailExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
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

    private function generateHeadings()
    {
        return [
            ['Laporan Detail Distribusi Obat Periode ' . Carbon::parse($this->dateStart)->format('d F Y') . ' - ' . Carbon::parse($this->dateEnd)->format('d F Y')],
            [],
            [
                'No.',
                'Tanggal',
                'Batch ID',
                'Unit Penerima',
                'Nama Obat',
                'Satuan',
                'Jumlah',
                'Kadaluarsa',
            ],
        ];
    }

    private function getRowData()
    {
        $results = [];
        $loop = 1;
        foreach ($this->data as $key => $value) {
            $details = $value->medicine_outs;
            foreach ($details as $keyDetails => $valueDetails) {
                $batchId = $value->batch_id;
                $location = $value->location->name;
                $date = Carbon::parse($value->date)->format('d/m/Y');
                $tmp = [
                    $loop,
                    $date,
                    $batchId,
                    $location,
                    $valueDetails->medicine->name,
                    $valueDetails->unit->name,
                    $valueDetails->qty,
                    Carbon::parse($valueDetails->expired_date)->format('d/m/Y'),
                ];
                $loop += 1;
                array_push($results, $tmp);
            }
            array_push($results, []);
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

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Detail Distribusi Obat';
    }
}
