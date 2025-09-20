<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('devices')->insert([
            ['branch_id' => 1,  'device_number' => '63211967'],
            ['branch_id' => 1,  'device_number' => '81823241'],
            ['branch_id' => 6,  'device_number' => '81393557'],
            ['branch_id' => 7,  'device_number' => '81386544'],
            ['branch_id' => 8,  'device_number' => '81826252'],
            ['branch_id' => 8,  'device_number' => '81096203'],
            ['branch_id' => 9,  'device_number' => '81397918'],
            ['branch_id' => 9,  'device_number' => '81393341'],
            ['branch_id' => 10, 'device_number' => '81392710'],
            ['branch_id' => 11, 'device_number' => '81826331'],
            ['branch_id' => 12, 'device_number' => '81388125'],
            ['branch_id' => 14, 'device_number' => '81391322'],
            ['branch_id' => 14, 'device_number' => '81382924'],
            ['branch_id' => 16, 'device_number' => '81395291'],
            ['branch_id' => 17, 'device_number' => '81550085'],
            ['branch_id' => 18, 'device_number' => '81826262'],
            ['branch_id' => 19, 'device_number' => '81555580'],
            ['branch_id' => 20, 'device_number' => '81394365'],
        ]);
    }
}
