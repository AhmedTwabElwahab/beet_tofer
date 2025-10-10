<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CashierInput;
use Illuminate\Http\Request;

class CashierInputController extends Controller
{
    public function index(Request $request)
    {
        $query = CashierInput::with('branch')->latest();

        // فلترة حسب التاريخ
        if ($request->has('filter_date') && $request->filter_date != '') {
            $query->whereDate('input_date', $request->filter_date);
        }

        $cashierInputs = $query->paginate(15)->withQueryString(); // يحافظ على قيمة الفلتر عند التنقل بين الصفحات

        return view('cashier_inputs.index', compact('cashierInputs'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('cashier_inputs.create', compact('branches'));
    }

    public function edit($id)
    {
        $cashierInput = CashierInput::findOrFail($id);
        $branches = Branch::all();

        return view('cashier_inputs.edit', compact('cashierInput', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'input_date'        => 'required|date',
            'branch_id'         => 'required|exists:branches,id',
            'cashier_number'    => 'required|string|max:50',
            'cash_value'        => 'required|numeric|min:0',
            'network_value'     => 'required|numeric|min:0',
            'sales_return'      => 'required|numeric|min:0',
            'bond_number'      => 'required|numeric|min:0',
        ]);

        $cashierInput = CashierInput::findOrFail($id);
        $cashierInput->update([
            'input_date' => $request->input_date,
            'branch_id' => $request->branch_id,
            'cashier_number' => $request->cashier_number,
            'cash_value' => $request->cash_value,
            'network_value' => $request->network_value,
            'sales_return' => $request->sales_return,
            'bond_number' => $request->bond_number,
        ]);

        return redirect()->route('cashier.input.index')->with('success', 'تم تحديث السجل بنجاح ✅');
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

    public function destroy($id)
    {
        $input = CashierInput::findOrFail($id);
        $input->delete();

        return redirect()->route('cashier.input.index')
            ->with('success', 'تم حذف السجل بنجاح ✅');
    }
}
