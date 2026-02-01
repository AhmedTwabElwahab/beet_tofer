<?php
use App\Http\Controllers\BranchMetricsController;
use Illuminate\Support\Facades\Route;

Route::post('/metrics/import', [BranchMetricsController::class, 'import']);
