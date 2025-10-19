<?php

namespace App\Exports;

use App\Models\CashierInput;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CashierAuditSingleSheetExport implements FromCollection, WithEvents
{
    protected $date;
    protected $from;
    protected $to;

    public function __construct($date = null, $from = null, $to = null)
    {
        $this->date = $date;
        $this->from = $from;
        $this->to = $to;
    }

    public function title(): string
    {
        return "ALL";
    }

    public function collection()
    {
        return collect([]);
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

                $branches = CashierInput::select('branch_id')->distinct()->pluck('branch_id');

                $startRow = 1;

                foreach ($branches as $branchId) {
                    // ======== عنوان الفرع ========
                    $sheet->mergeCells("A{$startRow}:M{$startRow}");
                    $sheet->setCellValue("A{$startRow}", "الفرع {$branchId}");
                    $sheet->getStyle("A{$startRow}")->getFont()->setBold(true)->setSize(14)->getColor()->setRGB('FFFFFF');
                    $sheet->getStyle("A{$startRow}")->getAlignment()->setHorizontal('center');
                    $sheet->getStyle("A{$startRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4B5563'); // رمادي داكن
                    $startRow++;

                    $cashiers = CashierInput::where('branch_id', $branchId)
                        ->distinct()
                        ->pluck('cashier_number');

                    $allDates = CashierInput::where('branch_id', $branchId)
                        ->when($this->date, fn($q) => $q->whereDate('input_date', $this->date))
                        ->when($this->from && $this->to, fn($q) => $q->whereBetween('input_date', [$this->from, $this->to]))
                        ->select('input_date')
                        ->distinct()
                        ->orderBy('input_date', 'asc')
                        ->pluck('input_date');

                    $maxRows = count($allDates) + 2;

                    $colIndex = 1;

                    foreach ($cashiers as $cashierNumber) {
                        $row = $startRow;

                        // ======== عنوان الكاشير ========
                        $sheet->mergeCells($this->getExcelColumnName($colIndex) . $row . ':' . $this->getExcelColumnName($colIndex + 5) . $row);
                        $sheet->setCellValue($this->getExcelColumnName($colIndex) . $row, "كاشير {$cashierNumber}");
                        $sheet->getStyle($this->getExcelColumnName($colIndex) . $row)->getFont()->setBold(true)->setSize(12)->getColor()->setRGB('FFFFFF');
                        $sheet->getStyle($this->getExcelColumnName($colIndex) . $row)->getAlignment()->setHorizontal('center');
                        $sheet->getStyle($this->getExcelColumnName($colIndex) . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('6B7280'); // رمادي متوسط

                        $row++;

                        // ======== رؤوس الأعمدة ========
                        $headers = ['تاريخ', 'رصيد', 'كاش', 'شبكة', 'مرتجع', 'الفرق'];
                        foreach ($headers as $i => $header) {
                            $sheet->setCellValue($this->getExcelColumnName($colIndex + $i) . $row, $header);
                            $sheet->getStyle($this->getExcelColumnName($colIndex + $i) . $row)->getFont()->setBold(true)->getColor()->setRGB('111827');
                            $sheet->getStyle($this->getExcelColumnName($colIndex + $i) . $row)->getAlignment()->setHorizontal('center');
                            $sheet->getStyle($this->getExcelColumnName($colIndex + $i) . $row)
                                ->getFill()->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()->setRGB('D1D5DB'); // رمادي فاتح
                            $sheet->getStyle($this->getExcelColumnName($colIndex + $i) . $row)
                                ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                        }

                        $row++;

                        // ======== البيانات ========
                        $inputs = CashierInput::select(
                            'input_date',
                            DB::raw('SUM(cash_value) as total_cash'),
                            DB::raw('SUM(network_value) as total_network'),
                            DB::raw('SUM(sales_return) as total_sales_return')
                        )
                            ->where('branch_id', $branchId)
                            ->where('cashier_number', $cashierNumber)
                            ->when($this->date, fn($q) => $q->whereDate('input_date', $this->date))
                            ->when($this->from && $this->to, fn($q) => $q->whereBetween('input_date', [$this->from, $this->to]))
                            ->groupBy('input_date')
                            ->orderBy('input_date', 'asc')
                            ->get()
                            ->keyBy(fn($i) => Carbon::parse($i->input_date)->format('Y-m-d'));

                        $balances = DB::table('cashier_audits')
                            ->where('branch_id', $branchId)
                            ->where('cashier_number', $cashierNumber)
                            ->when($this->date, fn($q) => $q->whereDate('date', $this->date))
                            ->when($this->from && $this->to, fn($q) => $q->whereBetween('date', [$this->from, $this->to]))
                            ->pluck('balance', 'date');

                        $fillToggle = false;

                        foreach ($allDates as $dateVal) {
                            $d = Carbon::parse($dateVal)->format('Y-m-d');
                            $formattedDate = Carbon::parse($dateVal)->format('d/m/Y');

                            $sheet->setCellValue($this->getExcelColumnName($colIndex) . $row, $formattedDate);
                            $tx = $inputs[$d] ?? null;
                            $balance = $balances[$d] ?? '';

                            $sheet->setCellValue($this->getExcelColumnName($colIndex + 1) . $row, $balance);
                            $sheet->setCellValue($this->getExcelColumnName($colIndex + 2) . $row, $tx->total_cash ?? '');
                            $sheet->setCellValue($this->getExcelColumnName($colIndex + 3) . $row, $tx->total_network ?? '');
                            $sheet->setCellValue($this->getExcelColumnName($colIndex + 4) . $row, $tx->total_sales_return ?? '');
                            $sheet->setCellValue($this->getExcelColumnName($colIndex + 5) . $row, "={$this->getExcelColumnName($colIndex+1)}{$row}-({$this->getExcelColumnName($colIndex+2)}{$row}+{$this->getExcelColumnName($colIndex+3)}{$row}+{$this->getExcelColumnName($colIndex+4)}{$row})");

                            // خطوط للخلايا وتظليل صفوف متناوبة
                            for ($i = 0; $i <= 5; $i++) {
                                $cell = $this->getExcelColumnName($colIndex + $i) . $row;
                                $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                                $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)
                                    ->getStartColor()->setRGB($fillToggle ? 'F3F4F6' : 'FFFFFF');
                            }

                            $fillToggle = !$fillToggle;
                            $row++;
                        }

                        $colIndex += 7; // الانتقال للكاشير التالي + عمود فاصل
                    }

                    $startRow += $maxRows + 2; // الانتقال للفرع التالي
                }

                // ضبط عرض الأعمدة
                for ($i = 1; $i <= 50; $i++) {
                    $sheet->getColumnDimension($this->getExcelColumnName($i))->setWidth(14);
                }
            }
        ];
    }
}
