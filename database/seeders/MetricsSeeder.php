<?php

namespace Database\Seeders;

use App\Models\metrics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metrics = [
            [
                'key'      => 'sales_smoke',
                'name'     => 'مبيعات الدخان',
                'category' => 'sales',
                'order' => 2
            ],
            [
                'key'      => 'sales_today',
                'name'     => 'مبيعات اليوم',
                'category' => 'sales',
                'order' => 1
            ],
            [
                'key'      => 'sales_telecom',
                'name'     => 'مبيعات الاتصالات',
                'category' => 'sales',
                'order' => 3
            ],
            [
                'key'      => 'sales_dezrt',
                'name'     => 'مبيعات الدزرت',
                'category' => 'sales',
                'order' => 4
            ],
            [
                'key'      => 'sales_veeb',
                'name'     => 'مبيعات الفيبات + التيريا',
                'category' => 'sales',
                'order' => 5
            ],

//            // 🔹 مخزن
//            [
//                'key'      => 'stock_value',
//                'name'     => 'قيمة المخزن',
//                'category' => 'stock',
//            ],
//            [
//                'key'      => 'stock_qty',
//                'name'     => 'كمية المخزن',
//                'category' => 'stock',
//            ],
//
//            // 🔹 فلوس
//            [
//                'key'      => 'cash_balance',
//                'name'     => 'رصيد الكاش',
//                'category' => 'finance',
//            ],
        ];

        foreach ($metrics as $metric) {
            metrics::updateOrCreate(
                ['key' => $metric['key']],
                $metric
            );
        }
    }
}
