<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionImportController extends Controller
{
    public function show()
    {
        return view('transaction-import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new TransactionImport, $request->file('file'));
            
            return redirect()->back()->with('success', 'Transactions imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing transactions: ' . $e->getMessage());
        }
    }
}
