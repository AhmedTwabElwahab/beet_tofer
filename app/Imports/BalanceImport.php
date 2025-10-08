<?php

namespace App\Imports;

use App\Models\cashier_audit;
use App\Models\cashierUsers;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class BalanceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user_id = $row['user_id'] ?? null;
            $balance = $row['balance'] ?? null;
            $rawDate = $row['date'] ?? null;


            if (!$user_id || !$balance || !$rawDate) {
                continue; // Skip invalid rows
            }

            if (is_numeric($rawDate))
            {
                // Excel numeric date
                $date = Carbon::instance(ExcelDate::excelToDateTimeObject($rawDate));
            } else {
                // String date
                $date = Carbon::createFromFormat('j/m/Y', $rawDate);
            }

            // Find device by device_number
            $user = cashierUsers::where('user_id', $user_id)->first();

            if ($user)
            {
                cashier_audit::create([
                    'date'            => $date,
                    'branch_id'       => $user->branch_id,
                    'user_id'         => $user_id,
                    'balance'         => $balance,
                    'cashier_number'  => $user->cashier_number,
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'branch_id' => 'required|string',
            'balance'   => 'required|numeric',
            'date'      => 'required|date',
        ];
    }
}
