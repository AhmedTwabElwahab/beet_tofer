<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashierUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cashier_users')->insert([
            ['branch_id' => 1,  'cashier_number' => 2, 'user_id' => 101],
            ['branch_id' => 1,  'cashier_number' => 3, 'user_id' => 102],
            ['branch_id' => 6,  'cashier_number' => 24, 'user_id' => 207],
            ['branch_id' => 6,  'cashier_number' => 25,  'user_id' => 208],
            ['branch_id' => 11,  'cashier_number' => 42,  'user_id' => 205],
            ['branch_id' => 11,  'cashier_number' => 43,  'user_id' => 206],
            ['branch_id' => 9,  'cashier_number' => 34,  'user_id' => 213],
            ['branch_id' => 9,  'cashier_number' => 35,  'user_id' => 214],
            ['branch_id' => 7,  'cashier_number' => 26,  'user_id' => 209],
            ['branch_id' => 7,  'cashier_number' => 27,  'user_id' => 210],
            ['branch_id' => 8,  'cashier_number' => 16,  'user_id' => 203],
            ['branch_id' => 8,  'cashier_number' => 17,  'user_id' => 204],
            ['branch_id' => 8,  'cashier_number' => 66,  'user_id' => 248],
            ['branch_id' => 10,  'cashier_number' => 36,  'user_id' => 215],
            ['branch_id' => 10,  'cashier_number' => 37,  'user_id' => 216],
            ['branch_id' => 12,  'cashier_number' => 44,  'user_id' => 219],
            ['branch_id' => 12,  'cashier_number' => 45,  'user_id' => 220],
            ['branch_id' => 14,  'cashier_number' => 48,  'user_id' => 221],
            ['branch_id' => 14,  'cashier_number' => 49,  'user_id' => 222],
            ['branch_id' => 13,  'cashier_number' => 47,  'user_id' => 224],
            ['branch_id' => 13,  'cashier_number' => 46,  'user_id' => 223],
            ['branch_id' => 17,  'cashier_number' => 55,  'user_id' => 241],
            ['branch_id' => 17,  'cashier_number' => 54,  'user_id' => 242],
            ['branch_id' => 16,  'cashier_number' => 58,  'user_id' => 243],
            ['branch_id' => 16,  'cashier_number' => 57,  'user_id' => 244],
            ['branch_id' => 18,  'cashier_number' => 63,  'user_id' => 245],
            ['branch_id' => 18,  'cashier_number' => 62,  'user_id' => 246],
            ['branch_id' => 19,  'cashier_number' => 68,  'user_id' => 249],
            ['branch_id' => 19,  'cashier_number' => 67,  'user_id' => 250],
            ['branch_id' => 20,  'cashier_number' => 70,  'user_id' => 251],
            ['branch_id' => 20,  'cashier_number' => 71,  'user_id' => 252]
        ]);
    }
}
