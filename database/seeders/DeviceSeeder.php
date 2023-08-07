<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->delete();

        DB::table('devices')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Đầu ghi 1',
                    'position' => 'Phòng điều hành',
                    'ip' => '192.168.1.100',
                    'status' => 'ON',
                    'farm_id' => 1,
                    'device_category_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Đầu ghi 2',
                    'position' => 'Phòng điều hành',
                    'ip' => '192.168.1.101',
                    'status' => 'ON',
                    'farm_id' => 1,
                    'device_category_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Camera cổng khử trùng',
                    'position' => 'Cổng khử trùng',
                    'ip' => '192.168.1.200',
                    'status' => 'ON',
                    'farm_id' => 1,
                    'device_category_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Camera chuồng nái 1',
                    'position' => 'Chuồng nái 1',
                    'ip' => '192.168.1.201',
                    'status' => 'OFF',
                    'farm_id' => 2,
                    'device_category_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
        ));
    }
}
