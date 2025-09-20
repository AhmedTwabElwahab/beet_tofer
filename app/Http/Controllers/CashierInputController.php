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
            'global_date' => 'required|date',
        ]);

        $cashierNumbers = $request->input('cashier_numbers', []);
        $branchIds = $request->input('branch_ids', []);
        $cashValues = $request->input('cash_values', []);
        $networkValues = $request->input('network_values', []);
        $globalDate = $request->input('global_date');

        $recordsCreated = 0;

        // Process each section
        foreach ($cashierNumbers as $section => $cashiers) {
            // Get the branch ID for this section
            $sectionBranchId = $branchIds[$section] ?? null;
            
            if (!$sectionBranchId) continue;
            
            // Process each row in this section
            foreach ($cashiers as $row => $cashierNumber) {
                if (!empty($cashierNumber)) {
                    CashierInput::create([
                        'cashier_number' => $cashierNumber,
                        'branch_id' => $sectionBranchId,
                        'cash_value' => $cashValues[$section][$row] ?? 0,
                        'network_value' => $networkValues[$section][$row] ?? 0,
                        'input_date' => $globalDate,
                    ]);
                    $recordsCreated++;
                }
            }
        }

        return redirect()->back()->with('success', "Successfully saved {$recordsCreated} cashier input records!");
    }
}
