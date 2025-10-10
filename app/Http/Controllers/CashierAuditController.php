<?php

namespace App\Http\Controllers;

use App\Exports\CashierAuditExport;
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
            'date' => 'nullable|date',
            'export_type' => 'required|in:single,all',
        ]);

        // لو المستخدم اختار "كل التواريخ" نخلي $date = null
        $date = $request->export_type === 'all' ? null : $request->input('date');

        return Excel::download(new CashierAuditExport($date), 'cashier_audit_' . ($date ?? 'all') . '.xlsx');
    }

    /**
     * عرض قائمة بجميع السجلات. (Read All)
     */
    public function index(Request $request)
    {
        // 1. ابدأ ببناء الاستعلام دون تنفيذه (Query Builder)
        $query = cashier_audit::query();

        // أو إذا كان اسم النموذج عندك هو cashier_audit:
        // $query = cashier_audit::query();

        if ($request->filled('filter_date'))
        {
            $date = $request->input('filter_date');

            // 2. تطبيق شرط الفلترة على باني الاستعلام
            $query->whereDate('date', $date);
        }

        // 3. تنفيذ الاستعلام وترقيم الصفحات في الخطوة الأخيرة
        $audits = $query->latest('date')
            ->paginate(15)
            ->appends($request->query()); // للحفاظ على الفلتر عند التنقل بين الصفحات

        return view('balance_audits.index', compact('audits'));
    }

    /**
     * عرض نموذج إضافة سجل جديد. (Create Form)
     */
    public function create()
    {
        // يمكنك إرسال بيانات الفروع والمستخدمين هنا
        return view('balance_audits.create');
    }

    /**
     * تخزين سجل جديد. (Create/Store)
     */
    public function store(Request $request)
    {
        cashier_audit::create($request->all());

        return redirect()->route('balance-audits.index')
            ->with('success', 'Balance Audit created successfully.');
    }

    /**
     * عرض سجل محدد. (Read Single)
     */
    public function show(cashier_audit $balanceAudit)
    {
        return view('balance_audits.show', compact('balanceAudit'));
    }

    /**
     * عرض نموذج تعديل سجل محدد. (Update Form)
     */
    public function edit(cashier_audit $balanceAudit)
    {
        return view('balance_audits.edit', compact('balanceAudit'));
    }

    /**
     * تحديث سجل محدد. (Update)
     */
    public function update(Request $request, cashier_audit $balanceAudit)
    {
        $balanceAudit->update($request->all());

        return redirect()->route('balance-audits.index')
            ->with('success', 'Balance Audit updated successfully.');
    }

    /**
     * حذف سجل محدد. (Delete)
     */
    public function destroy(cashier_audit $balanceAudit)
    {
        $balanceAudit->delete();

        return redirect()->route('balance-audits.index')
            ->with('success', 'Balance Audit deleted successfully.');
    }
}
