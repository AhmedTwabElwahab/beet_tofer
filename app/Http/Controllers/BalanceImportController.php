<?php

namespace App\Http\Controllers;

use App\Imports\BalanceImport;
use App\Imports\TransactionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BalanceImportController extends Controller
{
    public function show()
    {
        return view('balance-import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new BalanceImport, $request->file('file'));

            return redirect()->back()->with('success', 'Balance imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing balances: ' . $e->getMessage());
        }
    }
}
