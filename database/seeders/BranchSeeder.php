<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            ['id' => 1,  'name' => 'توفير 1','cost_center'=>'101','acc_number'=>"1111010002"],
            ['id' => 6,  'name' => 'توفير 6','cost_center'=>'105','acc_number'=>"1111010015"],
            ['id' => 7,  'name' => 'توفير 7','cost_center'=>'106','acc_number'=>"1111010017"],
            ['id' => 8,  'name' => 'توفير 8','cost_center'=>'107','acc_number'=>"1111010010"],
            ['id' => 9,  'name' => 'توفير 9','cost_center'=>'108','acc_number'=>"1111010022"],
            ['id' => 10, 'name' => 'توفير 10','cost_center'=>'109','acc_number'=>"1111010023"],
            ['id' => 11, 'name' => 'توفير 11','cost_center'=>'111','acc_number'=>"1111010024"],
            ['id' => 13, 'name' => 'توفير 13','cost_center'=>'113','acc_number'=>"1111010026"],
            ['id' => 12, 'name' => 'توفير 12','cost_center'=>'112','acc_number'=>"1111010025"],
            ['id' => 14, 'name' => 'توفير 14','cost_center'=>'114','acc_number'=>"1111010027"],
            ['id' => 16, 'name' => 'توفير 16','cost_center'=>'116','acc_number'=>"1111010033"],
            ['id' => 17, 'name' => 'توفير 17','cost_center'=>'117','acc_number'=>"1111010030"],
            ['id' => 18, 'name' => 'توفير 18','cost_center'=>'118','acc_number'=>"1111010037"],
            ['id' => 19, 'name' => 'توفير 19','cost_center'=>'119','acc_number'=>"1111010040"],
            ['id' => 20, 'name' => 'توفير 20','cost_center'=>'120','acc_number'=>"1111010042"],
        ]);
    }
}
