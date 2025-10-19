<?php

namespace App\Http\Controllers;

use App\Exports\CashierAuditExport;
use App\Exports\CashierAuditSingleSheetExport;
use App\Models\cashier_audit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CashierAuditController extends Controller
{
    public function exportShow()
    {
        return view('Boxes-export');
    }

    public function export(Request $request)
    {
        $request->validate([
            'export_type'   => 'required|in:single,range,all',
            'date'          => 'nullable|date',
            'from_date'     => 'nullable|date',
            'to_date'       => 'nullable|date|after_or_equal:from_date',
        ]);

        $date = null;
        $from = null;
        $to = null;

        // تحديد نوع التصدير
        switch ($request->export_type) {
            case 'single':
                $date = $request->input('date');
                $fileName = 'cashier_audit_' . ($date ?? now()->format('Y-m-d')) . '.xlsx';
                // استخدام الكود القديم لكل فرع في شيت منفصل
                return Excel::download(new CashierAuditExport($date), $fileName);

            case 'range':
                $from = $request->input('from_date');
                $to = $request->input('to_date');
                $fileName = 'cashier_audit_' . ($from ?? 'start') . '_to_' . ($to ?? 'end') . '.xlsx';
                // استخدام الكود الجديد: شيت واحد لكل الفروع
                return Excel::download(new CashierAuditSingleSheetExport(null, $from, $to), $fileName);

            case 'all':
            default:
                $fileName = 'cashier_audit_all_dates.xlsx';
                // استخدام الكود القديم لكل فرع في شيت منفصل
                return Excel::download(new CashierAuditExport(), $fileName);
        }
    }



    public function index(Request $request)
    {
        $query = cashier_audit::query();

        if ($request->filled('filter_date')) {
            $date = $request->input('filter_date');
            $query->whereDate('date', $date);
        }

        $audits = $query->latest('date')
            ->paginate(15)
            ->appends($request->query());

        return view('balance_audits.index', compact('audits'));
    }

    public function create()
    {
        return view('balance_audits.create');
    }

    public function store(Request $request)
    {
        cashier_audit::create($request->all());

        return redirect()->route('balance-audits.index')
            ->with('success', 'Balance Audit created successfully.');
    }

    public function show(cashier_audit $balanceAudit)
    {
        return view('balance_audits.show', compact('balanceAudit'));
    }

    public function edit(cashier_audit $balanceAudit)
    {
        return view('balance_audits.edit', compact('balanceAudit'));
    }

    public function update(Request $request, cashier_audit $balanceAudit)
    {
        $balanceAudit->update($request->all());

        return redirect()->route('balance-audits.index')
            ->with('success', 'Balance Audit updated successfully.');
    }

    public function destroy(cashier_audit $balanceAudit)
    {
        $balanceAudit->delete();

        return redirect()->route('balance-audits.index')
            ->with('success', 'Balance Audit deleted successfully.');
    }
}
