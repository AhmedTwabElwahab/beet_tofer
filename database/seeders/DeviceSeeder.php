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
            ['device_number' => 63282476, 'branch_id' => 7],
            ['device_number' => 64217132, 'branch_id' => 10],
            ['device_number' => 63282480, 'branch_id' => 10],
            ['device_number' => 81096215, 'branch_id' => 11],
            ['device_number' => 81096203, 'branch_id' => 8],
            ['device_number' => 81096219, 'branch_id' => 16],
            ['device_number' => 63282488, 'branch_id' => 9],
            ['device_number' => 81096207, 'branch_id' => 12],
            ['device_number' => 63211983, 'branch_id' => 20],
            ['device_number' => 64217165, 'branch_id' => 12],
            ['device_number' => 63282484, 'branch_id' => 6],
            ['device_number' => 64217119, 'branch_id' => 6],
            ['device_number' => 64217162, 'branch_id' => 11],
            ['device_number' => 15100002, 'branch_id' => 7],
            ['device_number' => 15100003, 'branch_id' => 8],
            ['device_number' => 15100430, 'branch_id' => 16],
            ['device_number' => 81382893, 'branch_id' => 17],
            ['device_number' => 81382902, 'branch_id' => 14],
            ['device_number' => 81382929, 'branch_id' => 9],
            ['device_number' => 81382924, 'branch_id' => 14],
        ]);
    }
}
