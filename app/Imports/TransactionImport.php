<?php

namespace App\Imports;

use App\Models\Device;
use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TransactionImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $deviceNumber = $row['device_number'] ?? null;
            $amount = $row['amount'] ?? null;
            $date = $row['date'] ?? null;

            if (!$deviceNumber || !$amount || !$date) {
                continue; // Skip invalid rows
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
