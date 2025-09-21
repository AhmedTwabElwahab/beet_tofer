<?php

namespace App\Imports;

use App\Models\Device;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class TransactionImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $deviceNumber = $row['device_number'] ?? null;
            $amount = $row['amount'] ?? null;
            $rawDate = $row['date'] ?? null;


            if (!$deviceNumber || !$amount || !$rawDate) {
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
            $device = Device::where('device_number', $deviceNumber)->first();

            if ($device) {
                Transaction::create([
                    'branch_id' => $device->branch_id,
                    'device_id' => $device->id,
                    'amount' => $amount,
                    'transaction_date' => $date,
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'device_number' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ];
    }
}
