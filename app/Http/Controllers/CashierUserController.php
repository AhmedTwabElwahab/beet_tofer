<?php
namespace App\Http\Controllers;

use App\Models\CashierUser;
use App\Models\Branch;
use Illuminate\Http\Request;

class CashierUserController extends Controller
{
    public function index(Request $request)
    {
        $query = CashierUser::with('branch');

        // إذا أردت فلترة بالفرع بدلاً من التاريخ (لأن جدولك لا يحتوي على تاريخ إدخال منفصل بل timestamps)
        if ($request->filled('branch_id'))
        {
            $query->where('branch_id', $request->branch_id);
        }

        $cashiers = $query->latest()->paginate(10);
        return view('cashiers.index', compact('cashiers'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('cashiers.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'user_id' => 'required|integer|unique:cashier_users,user_id', // لضمان وجوده في فرع واحد فقط
            'cashier_number' => 'required|string',
        ]);

        CashierUser::create($validated);
        return redirect()->route('cashiers.index')->with('success', 'تم إضافة الكاشير بنجاح');
    }

    public function edit($cashier)
    {
        $branches = Branch::all();
        $cashierUser = CashierUser::find($cashier);
        if (!$cashierUser)
        {
            return redirect()->route('cashiers.index');
        }
        return view('cashiers.edit', compact('cashierUser', 'branches'));
    }

    public function update(Request $request, CashierUser $cashierUser)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'user_id' => 'required|integer|unique:cashier_users,user_id,' . $cashierUser->id,
            'cashier_number' => 'required|string',
        ]);

        $cashierUser->update($validated);
        return redirect()->route('cashiers.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(CashierUser $cashierUser)
    {
        $cashierUser->delete();
        return redirect()->route('cashiers.index')->with('success', 'تم الحذف بنجاح');
    }
}
