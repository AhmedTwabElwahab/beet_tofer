<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CashierInput;
use Illuminate\Http\Request;

class CashierInputController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('cashier-input', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cashier_numbers' => 'required|array',
            'branch_ids' => 'required|array',
            'cash_values' => 'required|array',
            'network_values' => 'required|array',
            'sales_return' => 'required|array',
            'global_date' => 'required|date',
            'bond_number' => 'required|array',
        ]);

        $cashierNumbers = $request->input('cashier_numbers', []);
        $branchIds = $request->input('branch_ids', []);
        $cashValues = $request->input('cash_values', []);
        $networkValues = $request->input('network_values', []);
        $sales_return = $request->input('sales_return', []);
        $globalDate = $request->input('global_date');
        $bond_number = $request->input('bond_number', []);

        $recordsCreated = 0;

        // Process each section
        foreach ($cashierNumbers as $section => $cashiers) {
            // Get the branch ID for this section
            $sectionBranchId = $branchIds[$section] ?? null;

            if (!$sectionBranchId) continue;

            // Process each row in this section
            foreach ($cashiers as $row => $cashierNumber) {
                if (!empty($cashierNumber))
                {
                    CashierInput::create([
                        'cashier_number'    => $cashierNumber,
                        'branch_id'         => $sectionBranchId,
                        'cash_value'        => $cashValues[$section][$row] ?? 0,
                        'network_value'     => $networkValues[$section][$row] ?? 0,
                        'sales_return'      => $sales_return[$section][$row] ?? 0,
                        'bond_number'       => $bond_number[$section][$row] ?? 0,
                        'input_date'        => $globalDate,
                    ]);
                    $recordsCreated++;
                }
            }
        }

        return redirect()->back()->with('success', "Successfully saved {$recordsCreated} cashier input records!");
    }
}
