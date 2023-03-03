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

class StockAdjustmentDetailExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle, WithStrictNullComparison
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
            ['Laporan Detail Penyesuaian Stock Obat Periode ' . Carbon::parse($this->dateStart)->format('d F Y') . ' - ' . Carbon::parse($this->dateEnd)->format('d F Y')],
            [],
            [
                'No.',
                'Tanggal',
                'Batch ID',
                'Nama Obat',
                'Satuan',
                'Kadaluarsa',
                'Jumlah Sistem',
                'Jumlah Sebenarnya',
                'Selisih',
                'Keterangan'
            ]
        ];
    }

    public function getRowData()
    {
        $results = [];
        $loop = 1;
        foreach ($this->data as $key => $value) {
            $details = $value->details;
            foreach ($details as $detail) {
                $diffQty = $detail->real_qty - $detail->current_qty;
                $tmp = [
                    $loop,
                    Carbon::parse($value->date)->format('d/m/Y'),
                    $value->batch_id,
                    $detail->medicine->name,
                    $detail->medicine->unit->name,
                    Carbon::parse($detail->expired_date)->format('d/m/Y'),
                    $detail->current_qty,
                    $detail->real_qty,
                    $diffQty,
                    strtoupper($detail->description),
                ];
                $loop += 1;
                array_push($results, $tmp);
            }

        }
        return $results;
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Detail Penyesuaian Obat';
    }
}
