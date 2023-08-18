<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device_logs')->delete();

        DB::table('device_logs')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'device_id' => 16,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            1 =>
                array (
                    'id' => 2,
                    'device_id' => 18,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            2 =>
                array (
                    'id' => 3,
                    'device_id' => 20,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            3 =>
                array (
                    'id' => 4,
                    'device_id' => 21,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            4 =>
                array (
                    'id' => 5,
                    'device_id' => 22,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            5 =>
                array (
                    'id' => 6,
                    'device_id' => 23,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            6 =>
                array (
                    'id' => 7,
                    'device_id' => 26,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            7 =>
                array (
                    'id' => 8,
                    'device_id' => 27,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            8 =>
                array (
                    'id' => 9,
                    'device_id' => 30,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            9 =>
                array (
                    'id' => 10,
                    'device_id' => 33,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            10 =>
                array (
                    'id' => 11,
                    'device_id' => 34,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            11 =>
                array (
                    'id' => 12,
                    'device_id' => 21,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-11 17:00:00.000',
                    'updated_at' => '2023-07-11 17:00:00.000',
                ),
            12 =>
                array (
                    'id' => 13,
                    'device_id' => 26,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-13 11:00:00.000',
                    'updated_at' => '2023-07-13 11:00:00.000',
                ),
            13 =>
                array (
                    'id' => 14,
                    'device_id' => 34,
                    'old_category_id' => 1,
                    'new_category_id' => 1,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-13 11:00:00.000',
                    'updated_at' => '2023-07-13 11:00:00.000',
                ),
            14 =>
                array (
                    'id' => 15,
                    'device_id' => 4,
                    'old_category_id' => 2,
                    'new_category_id' => 2,
                    'action' => 'CHANGE_STATUS',
                    'old_status' => 'ON',
                    'new_status' => 'OFF',
                    'created_at' => '2023-07-26 11:00:00.000',
                    'updated_at' => '2023-07-26 11:00:00.000',
                ),
        ));
    }
}
