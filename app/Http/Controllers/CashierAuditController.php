<?php

namespace App\Http\Controllers;

use App\Exports\CashierAuditExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CashierAuditController extends Controller
{
    public function index()
    {
        return view('Boxes-export');
    }
    public function export(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date',
            'export_type' => 'required|in:single,all',
        ]);

        // لو المستخدم اختار "كل التواريخ" نخلي $date = null
        $date = $request->export_type === 'all' ? null : $request->input('date');

        return Excel::download(new CashierAuditExport($date), 'cashier_audit_' . ($date ?? 'all') . '.xlsx');
    }


}
