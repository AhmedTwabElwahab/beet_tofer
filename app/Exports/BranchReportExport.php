<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\metrics;
use App\Models\branch_metrics;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize,
    WithEvents
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\{
    Border,
    Fill,
    Alignment
};
use Maatwebsite\Excel\Events\AfterSheet;

class BranchReportExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize,
    WithEvents
{
    protected $metrics;
    protected $rowsCount;

    public function __construct()
    {
        $this->metrics = metrics::orderBy('id')->get();
    }

    public function collection()
    {
        $rows = collect();
        $branches = Branch::orderBy('id')->get();

        foreach ($branches as $branch) {

            $row = [
                'branch' => $branch->name,
            ];

            foreach ($this->metrics as $metric) {
                $row[$metric->key] = branch_metrics::where('branch_id', $branch->id)
                    ->where('metric_id', $metric->id)
                    ->sum('value');
            }

            $rows->push($row);
        }

        // Total row
        $total = ['branch' => 'الإجمالي'];
        foreach ($this->metrics as $metric) {
            $total[$metric->key] = $rows->sum($metric->key);
        }
        $rows->push($total);

        $this->rowsCount = $rows->count() + 1; // + header

        return new Collection($rows);
    }

    public function headings(): array
    {
        return array_merge(
            ['اسم الفرع'],
            $this->metrics->pluck('name')->toArray()
        );
    }

    public function styles(Worksheet $sheet)
    {
        // RTL
        $sheet->setRightToLeft(true);

        // Header style
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'], // رمادي غامق
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Body style
        $sheet->getStyle('A2:' . $sheet->getHighestColumn() . $this->rowsCount)
            ->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'numberFormat' => [
                    'formatCode' => '#,##0.00',
                ],
            ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow = $this->rowsCount;

                // Total row style
                $sheet->getStyle("A{$lastRow}:" . $sheet->getHighestColumn() . "{$lastRow}")
                    ->applyFromArray([
                        'font' => [
                            'bold' => true,
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'E5E7EB'], // رمادي فاتح
                        ],
                    ]);
            },
        ];
    }
}
