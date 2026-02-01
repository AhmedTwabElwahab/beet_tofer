<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\branch_metrics;
use App\Models\metrics;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchReportExport implements FromArray, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function headings(): array
    {
        $metrics = metrics::orderBy('order')->get();

        return array_merge(
            ['الفرع'],
            $metrics->pluck('name')->toArray()
        );
    }

    public function array(): array
    {
        $metrics = metrics::orderBy('order')->get();

        $rows = [];

        foreach (Branch::all() as $branch) {

            $row = [$branch->name];

            foreach ($metrics as $metric) {

                $value = branch_metrics::where([
                    'branch_id' => $branch->id,
                    'metric_id' => $metric->id,
                    'date'      => $this->date
                ])->value('value');

                $row[] = $value ?? 0;
            }

            $rows[] = $row;
        }

        return $rows;
    }
}
