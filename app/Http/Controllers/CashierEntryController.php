<?php

namespace App\Http\Controllers;

use App\Exports\CashierEntryExport;
use App\Models\Branch;
use App\Models\cashierEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CashierEntryController extends Controller
{
    public function show()
    {
        return view('cashierEntry-export');
    }

    public function export(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->input('date');

        $entry = cashierEntry::where('due_date', $date)->first();

        if ($entry == null)
        {
            $branches = Branch::with(['cashierInputs', 'transactions'])->get();
            $new_date = Carbon::parse($date)->format('j/m/Y');

            $entry = new cashierEntry();
            $entry->account_number      = "1111010008";
            $entry->analytical_account  = "";
            $entry->description         = "إضافة مبيعات صناديق الكاشيرات الي الصندوق الوسيط بتاريخ ".$new_date;
            $entry->credit_local        = 0;
            $entry->debit_local         = 0;
            $entry->cost_center         = '101';
            $entry->due_date            = $date;
            $entry->save();


            foreach ($branches as $branch)
            {
                if ($branch->cashierInputs->count() > 0)
                {
                    foreach ($branch->cashierInputs as $cashierInput)
                    {
                        if(Carbon::parse($cashierInput->input_date)->toDateString() === Carbon::parse($date)->toDateString())
                        {
                            $description = "إضافة مبيعات صناديق الكاشيرات الي الصندوق الوسيط بتاريخ ".$new_date;

                            if ($cashierInput->bond_number != null)
                            {
                                $bond_number = (int) floatval($cashierInput->bond_number);
                                $description = "ترحيل مبيعات صناديق الكاشيرات إلى الصندوق الوسيط عن يوم {$new_date} برقم السند {$bond_number}";
                            }

                            $entry = new cashierEntry();
                            $entry->account_number      = $branch->acc_number;
                            $entry->analytical_account  = $cashierInput->cashier_number;
                            $entry->description         = $description;
                            $entry->debit_local         = 0;
                            $entry->credit_local        = $cashierInput->cash_value;
                            $entry->cost_center         = $branch->cost_center;
                            $entry->due_date            = $cashierInput->input_date;

                            $entry->save();
                        }
                    }
                }

            }
        }

        return Excel::download(new CashierEntryExport($date), "cashierEntry_report_{$date}.xlsx");
    }
}
