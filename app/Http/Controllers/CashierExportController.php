<?php

namespace App\Http\Controllers;

use App\Exports\CashierExport;
use App\Models\Branch;
use App\Models\CashierInput;
use App\Models\networkEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
class CashierExportController extends Controller
{
    public function show()
    {
        return view('cashier-export');
    }

    public function export(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->input('date');

        $entry = networkEntry::where('due_date', $date)->first();

        if ($entry == null)
        {
            $branches = Branch::with(['cashierInputs', 'transactions'])->get();
            $new_date = Carbon::parse($date)->format('j/m/Y');
            foreach ($branches as $branch)
            {
                $count = 0;
                $sumDebit = 0;
                $sumCredit = 0;
                if ($branch->transactions->count() > 0)
                {
                    foreach ($branch->transactions as $transaction)
                    {
                        if(Carbon::parse($transaction->transaction_date)->toDateString() === Carbon::parse($date)->toDateString())
                        {
                            $count++;
                            $sumDebit = $sumDebit + $transaction->amount;
                            $entry = new networkEntry();
                            $entry->account_number      = "1112010002";
                            $entry->analytical_account  = 2;
                            $entry->description         = "اقفال صناديق الكاشيرات مبيعات الشبكة بتاريخ ".$new_date;
                            $entry->debit_local         = $transaction->amount;
                            $entry->credit_local        = 0;
                            $entry->cost_center         = $branch->cost_center;
                            $entry->due_date            = $transaction->transaction_date;
                            $entry->save();
                        }
                    }
                }
                if ($branch->cashierInputs->count() > 0)
                {
                    foreach ($branch->cashierInputs as $cashierInput)
                    {
                        if(Carbon::parse($cashierInput->input_date)->toDateString() === Carbon::parse($date)->toDateString())
                        {
                            $count++;
                            $sumCredit = $sumCredit + $cashierInput->network_value;

                            $entry = new networkEntry();
                            $entry->account_number      = $branch->acc_number;
                            $entry->analytical_account  = $cashierInput->cashier_number;
                            $entry->description         = "اقفال صناديق الكاشيرات مبيعات الشبكة بتاريخ ".$new_date;
                            $entry->debit_local         = 0;
                            $entry->credit_local        = $cashierInput->network_value;
                            $entry->cost_center         = $branch->cost_center;
                            $entry->due_date            = $cashierInput->input_date;

                            $entry->save();
                        }
                    }
                }
                if ($count > 0)
                {
                    $entry = new networkEntry();
                    $entry->account_number      = "3221010004";
                    $entry->analytical_account  = "";
                    $entry->description         = "اقفال صناديق الكاشيرات مبيعات الشبكة بتاريخ ".$new_date;
                    if ($sumDebit > $sumCredit)
                    {
                        $entry->credit_local        = $sumDebit - $sumCredit;
                    }else
                    {
                        $entry->debit_local         = $sumCredit - $sumDebit;
                    }
                    $entry->cost_center         = $branch->cost_center;
                    $entry->due_date            = $date;
                    $entry->save();
                }
            }
        }

        return Excel::download(new CashierExport($date), "cashier_report_{$date}.xlsx");
    }
}
