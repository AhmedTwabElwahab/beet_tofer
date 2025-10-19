<?php

namespace App\Exports;

use App\Models\CashierInput;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CashierAuditExport implements WithMultipleSheets
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

    public function sheets(): array
    {
        $branches = CashierInput::select('branch_id')
            ->distinct()
            ->pluck('branch_id');

        $sheets = [];

        foreach ($branches as $branchId) {
            $sheets[] = new CashierAuditBranchSheet($branchId, $this->date, $this->from, $this->to);
        }

        return $sheets;
    }
}
