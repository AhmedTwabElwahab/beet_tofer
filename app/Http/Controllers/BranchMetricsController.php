<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\branch_metrics;
use App\Models\metrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BranchMetricsController extends Controller
{
    public function import(Request $request)
    {
        // ✅ Validation
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|integer|exists:branches,id',
            'date'      => 'required|date',
            'metrics'   => 'required|array|min:1',
            'metrics.*.key'   => 'required|string|exists:metrics,key',
            'metrics.*.value' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // ✅ تأكيد الفرع
        $branch = Branch::find($validated['branch_id']);

        // ✅ Transaction عشان الأمان
        DB::beginTransaction();

        try {

            foreach ($validated['metrics'] as $item) {

                // نجيب الميتريك بالـ key
                $metric = metrics::where('key', $item['key'])->first();

                // Update أو Insert
                branch_metrics::updateOrCreate(
                    [
                        'branch_id' => $branch->id,
                        'metric_id' => $metric->id,
                        'date'      => $validated['date'],
                    ],
                    [
                        'value' => $item['value']
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Metrics imported successfully',
                'branch_id' => $branch->id,
                'date' => $validated['date']
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Import failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
