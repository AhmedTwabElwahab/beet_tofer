<?php

use App\Http\Controllers\CashierEntryController;
use App\Http\Controllers\CashierExportController;
use App\Http\Controllers\CashierInputController;
use App\Http\Controllers\TransactionImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Transaction Import Routes
Route::get('/transaction-import', [TransactionImportController::class, 'show'])->name('transaction.import.show');
Route::post('/transaction-import', [TransactionImportController::class, 'import'])->name('transaction.import');

// Cashier Input Routes
Route::get('/cashier-input', [CashierInputController::class, 'index'])->name('cashier.input.index');
Route::post('/cashier-input', [CashierInputController::class, 'store'])->name('cashier.input.store');

// Cashier Export Routes
Route::get('/cashier-export', [CashierExportController::class, 'show'])->name('cashier.export.show');
Route::post('/cashier-export', [CashierExportController::class, 'export'])->name('cashier.export');

// CashierEntry Export Routes
Route::get('/cashierentry-export', [CashierEntryController::class, 'show'])->name('cashierentry.export.show');
Route::post('/cashierentry-export', [CashierEntryController::class, 'export'])->name('cashierentry.export');
