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

class TransactionInDetailExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
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
            ['Laporan Detail Penerimaan Obat Periode ' . Carbon::parse($this->dateStart)->format('d F Y') . ' - ' . Carbon::parse($this->dateEnd)->format('d F Y')],
            [],
            [
                'No.',
                'Tanggal',
                'Batch ID',
                'Nama Obat',
                'Satuan',
                'Jumlah',
                'Harga (Rp.)',
                'Total (Rp.)',
                'Expired Date'
            ],
        ];
    }

    private function getRowData()
    {
        $results = [];

        foreach ($this->data as $key => $value) {
            $details = $value->medicine_ins;
            foreach ($details as $keyDetails => $valueDetails) {
                $batchId = $value->batch_id;
                $date = Carbon::parse($value->date)->format('d/m/Y');
                $tmp = [
                    ($keyDetails + 1),
                    $keyDetails !== 0 ? '' : $date,
                    $keyDetails !== 0 ? '' : $batchId,
                    $valueDetails->medicine->name,
                    $valueDetails->unit->name,
                    $valueDetails->qty,
                    $valueDetails->price,
                    $valueDetails->total,
                    $valueDetails->expired_date,
                ];
                array_push($results, $tmp);

            }
            array_push($results, []);
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
        return 'Detail Penerimaan Obat';
    }
}
