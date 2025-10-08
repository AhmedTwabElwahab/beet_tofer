<?php

namespace App\Exports;

use App\Models\CashierInput;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CashierAuditBranchSheet implements FromCollection, WithTitle, WithEvents
{
    protected $branchId;
    protected $date;

    public function __construct($branchId, $date = null)
    {
        $this->branchId = $branchId;
        $this->date = $date;
    }

    public function collection()
    {
        return collect([]);
    }

    public function title(): string
    {
        return "الفرع {$this->branchId}";
    }

    private function getExcelColumnName($index)
    {
        $name = '';
        while ($index > 0) {
            $index--;
            $name = chr(65 + $index % 26) . $name;
            $index = intdiv($index, 26);
        }
        return $name;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setRightToLeft(true);

                // الكاشيرات
                $cashiers = CashierInput::where('branch_id', $this->branchId)
                    ->select('cashier_number')
                    ->distinct()
                    ->pluck('cashier_number');

                // التواريخ
                $allDates = CashierInput::where('branch_id', $this->branchId)
                    ->when($this->date, fn($q) => $q->whereDate('input_date', $this->date))
                    ->select('input_date')
                    ->distinct()
                    ->orderBy('input_date', 'asc')
                    ->pluck('input_date');

                $startRow = 1;
                $startColIndex = 1;

                foreach ($cashiers as $cashierNumber) {
                    $colLetter = $this->getExcelColumnName($startColIndex);

                    // عنوان الكاشير
                    $mergeEnd = $this->getExcelColumnName($startColIndex + 5); // تم تمديده ليشمل عمود المعادلة
                    $sheet->mergeCells("{$colLetter}{$startRow}:{$mergeEnd}{$startRow}");
                    $sheet->setCellValue("{$colLetter}{$startRow}", "كاشير {$cashierNumber}");
                    $sheet->getStyle("{$colLetter}{$startRow}")->getFont()->setBold(true)->setSize(14);
                    $sheet->getStyle("{$colLetter}{$startRow}")->getAlignment()->setHorizontal('center');

                    // رؤوس الأعمدة
                    $headers = ['تاريخ', 'رصيد', 'كاش', 'شبكة', 'مرتجع', 'الفرق'];
                    $rowHeader = $startRow + 1;

                    foreach ($headers as $i => $header) {
                        $headerCol = $this->getExcelColumnName($startColIndex + $i);
                        $sheet->setCellValue("{$headerCol}{$rowHeader}", $header);
                        $sheet->getStyle("{$headerCol}{$rowHeader}")->getFont()->setBold(true);
                        $sheet->getStyle("{$headerCol}{$rowHeader}")->getAlignment()->setHorizontal('center');
                    }

                    // بيانات الكاشير
                    $inputs = CashierInput::select(
                        'input_date',
                        DB::raw('SUM(cash_value) as total_cash'),
                        DB::raw('SUM(network_value) as total_network'),
                        DB::raw('SUM(sales_return) as total_sales_return')
                    )
                        ->where('branch_id', $this->branchId)
                        ->where('cashier_number', $cashierNumber)
                        ->when($this->date, fn($q) => $q->whereDate('input_date', $this->date))
                        ->groupBy('input_date')
                        ->orderBy('input_date', 'asc')
                        ->get()
                        ->keyBy(fn($i) => Carbon::parse($i->input_date)->format('Y-m-d'));

                    // بيانات الرصيد
                    $balances = DB::table('cashier_audits')
                        ->where('branch_id', $this->branchId)
                        ->where('cashier_number', $cashierNumber)
                        ->pluck('balance', 'date');

                    // كتابة البيانات
                    $dataRow = $startRow + 2;

                    foreach ($allDates as $date) {
                        $d = Carbon::parse($date)->format('Y-m-d');
                        $formattedDate = Carbon::parse($date)->format('d/m/Y');

                        $sheet->setCellValue($this->getExcelColumnName($startColIndex) . $dataRow, $formattedDate);

                        $tx = $inputs[$d] ?? null;
                        $balance = $balances[$d] ?? '';

                        // كتابة القيم
                        $sheet->setCellValue($this->getExcelColumnName($startColIndex + 1) . $dataRow, $balance);
                        $sheet->setCellValue($this->getExcelColumnName($startColIndex + 2) . $dataRow, $tx->total_cash ?? '');
                        $sheet->setCellValue($this->getExcelColumnName($startColIndex + 3) . $dataRow, $tx->total_network ?? '');
                        $sheet->setCellValue($this->getExcelColumnName($startColIndex + 4) . $dataRow, $tx->total_sales_return ?? '');

                        // ✅ المعادلة: الرصيد - (الكاش + الشبكة + المرتجع)
                        $balanceCol = $this->getExcelColumnName($startColIndex + 1);
                        $cashCol = $this->getExcelColumnName($startColIndex + 2);
                        $networkCol = $this->getExcelColumnName($startColIndex + 3);
                        $returnCol = $this->getExcelColumnName($startColIndex + 4);
                        $diffCol = $this->getExcelColumnName($startColIndex + 5);

                        $formula = "={$balanceCol}{$dataRow}-({$cashCol}{$dataRow}+{$networkCol}{$dataRow}+{$returnCol}{$dataRow})";
                        $sheet->setCellValue($diffCol . $dataRow, $formula);

                        $dataRow++;
                    }

                    // فاصل بين الكاشيرات
                    $startColIndex += 7; // 6 أعمدة بيانات + 1 فاصل
                }

                // عرض الأعمدة
                for ($i = 1; $i < $startColIndex; $i++) {
                    $col = $this->getExcelColumnName($i);
                    $sheet->getColumnDimension($col)->setWidth(14);
                }
            },
        ];
    }
}
