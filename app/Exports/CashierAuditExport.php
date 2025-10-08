<?php

namespace App\Exports;

use App\Models\CashierInput;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CashierAuditExport implements WithMultipleSheets
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function sheets(): array
    {
        // نجلب كل الفروع الموجودة في النظام
        $branches = CashierInput::select('branch_id')
            ->distinct()
            ->pluck('branch_id');

        $sheets = [];

        foreach ($branches as $branchId)
        {
            $sheets[] = new CashierAuditBranchSheet($branchId, $this->date);
        }

        return $sheets;
    }
}
