<?php

use App\Http\Controllers\BalanceImportController;
use App\Http\Controllers\CashierAuditController;
use App\Http\Controllers\CashierEntryController;
use App\Http\Controllers\CashierExportController;
use App\Http\Controllers\CashierInputController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TransactionImportController;
use App\Models\cashierEntry;
use App\Models\networkEntry;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Transaction Import Routes
Route::get('/transaction-import', [TransactionImportController::class, 'show'])->name('transaction.import.show');
Route::post('/transaction-import', [TransactionImportController::class, 'import'])->name('transaction.import');

// Balance Import Routes
Route::get('/balance-import', [BalanceImportController::class, 'show'])->name('balance.import.show');
Route::post('/balance-import', [BalanceImportController::class, 'import'])->name('balance.import');

// Cashier Input Routes
Route::get('/cashier-input', [CashierInputController::class, 'index'])->name('cashier.input.index');
Route::get('/cashier-input/create', [CashierInputController::class, 'create'])->name('cashier.input.create');
Route::post('/cashier-input', [CashierInputController::class, 'store'])->name('cashier.input.store');
Route::get('/cashier-input/{date}/edit', [CashierInputController::class, 'edit'])->name('cashier.input.edit');
Route::put('/cashier-input/{date}', [CashierInputController::class, 'update'])->name('cashier.input.update');
Route::delete('/cashier-input/{date}', [CashierInputController::class, 'destroy'])->name('cashier.input.destroy');

// Cashier Export Routes
Route::get('/cashier-export', [CashierExportController::class, 'show'])->name('cashier.export.show');
Route::post('/cashier-export', [CashierExportController::class, 'export'])->name('cashier.export');

// CashierEntry Export Routes
Route::get('/cashierentry-export', [CashierEntryController::class, 'show'])->name('cashierentry.export.show');
Route::post('/cashierentry-export', [CashierEntryController::class, 'export'])->name('cashierentry.export');


Route::get('/delete', function () {
   networkEntry::truncate();
   cashierEntry::truncate();
   return view('home');
});

Route::get('/cashier_audits', [CashierAuditController::class, 'exportShow'])->name('cashieraudits.index');
Route::post('/cashier_audits', [CashierAuditController::class, 'export'])->name('cashieraudits.export');

// مسارات CRUD لـ Device
Route::resource('devices', DeviceController::class);

Route::resource('balance-audits', CashierAuditController::class);
