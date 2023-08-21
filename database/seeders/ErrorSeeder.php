<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ErrorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('errors')->delete();

        DB::table('errors')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'device_id' => 16,
                    'detection_time' => '2023-07-21 16:00:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm bị hỏng',
                    'solution' => 'Bấm lại đầu mạng',
                    'type_id' => 3,
                    'created_at' => '2023-07-21 17:00:00.000',
                    'updated_at' => '2023-07-21 17:00:00.000',
                ),
            1 =>
                array (
                    'id' => 2,
                    'device_id' => 18,
                    'detection_time' => '2023-07-21 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm bị hỏng',
                    'solution' => 'Bấm lại đầu mạng',
                    'type_id' => 3,
                    'created_at' => '2023-07-21 17:00:00.000',
                    'updated_at' => '2023-07-21 17:00:00.000',
                ),
            2 =>
                array (
                    'id' => 3,
                    'device_id' => 20,
                    'detection_time' => '2023-07-23 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đứt dây cam',
                    'solution' => 'Nối lại dây',
                    'type_id' => 4,
                    'created_at' => '2023-07-23 17:00:00.000',
                    'updated_at' => '2023-07-23 17:00:00.000',
                ),
            3 =>
                array (
                    'id' => 4,
                    'device_id' => 21,
                    'detection_time' => '2023-07-23 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đứt dây cam',
                    'solution' => 'Nối lại dây',
                    'type_id' => 4,
                    'created_at' => '2023-07-23 17:00:00.000',
                    'updated_at' => '2023-07-23 17:00:00.000',
                ),
            4 =>
                array (
                    'id' => 5,
                    'device_id' => 22,
                    'detection_time' => '2023-07-30 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm mạng hỏng',
                    'solution' => 'Bấm lại dây',
                    'type_id' => 3,
                    'created_at' => '2023-07-30 17:00:00.000',
                    'updated_at' => '2023-07-30 17:00:00.000',
                ),
            5 =>
                array (
                    'id' => 6,
                    'device_id' => 23,
                    'detection_time' => '2023-07-30 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm mạng hỏng',
                    'solution' => 'Bấm lại dây',
                    'type_id' => 3,
                    'created_at' => '2023-07-30 17:00:00.000',
                    'updated_at' => '2023-07-30 17:00:00.000',
                ),
            6 =>
                array (
                    'id' => 7,
                    'device_id' => 26,
                    'detection_time' => '2023-07-30 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm mạng hỏng',
                    'solution' => 'Bấm lại dây',
                    'type_id' => 3,
                    'created_at' => '2023-07-30 17:00:00.000',
                    'updated_at' => '2023-07-30 17:00:00.000',
                ),
            7 =>
                array (
                    'id' => 8,
                    'device_id' => 27,
                    'detection_time' => '2023-07-30 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm mạng hỏng',
                    'solution' => 'Bấm lại dây',
                    'type_id' => 3,
                    'created_at' => '2023-07-30 17:00:00.000',
                    'updated_at' => '2023-07-30 17:00:00.000',
                ),
            8 =>
                array (
                    'id' => 9,
                    'device_id' => 30,
                    'detection_time' => '2023-08-11 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Hỏng mắt cam',
                    'solution' => 'Đổi thiết bị mới',
                    'type_id' => 6,
                    'created_at' => '2023-08-11 17:00:00.000',
                    'updated_at' => '2023-08-11 17:00:00.000',
                ),
            9 =>
                array (
                    'id' => 10,
                    'device_id' => 33,
                    'detection_time' => '2023-08-11 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Hỏng mắt cam',
                    'solution' => 'Đổi thiết bị',
                    'type_id' => 6,
                    'created_at' => '2023-08-11 17:00:00.000',
                    'updated_at' => '2023-08-11 17:00:00.000',
                ),
            10 =>
                array (
                    'id' => 11,
                    'device_id' => 34,
                    'detection_time' => '2023-08-15 16:30:00.000',
                    'recovery_time' => null,
                    'cause' => 'Đầu bấm hỏng',
                    'solution' => 'Bấm lại',
                    'type_id' => 3,
                    'created_at' => '2023-08-15 17:00:00.000',
                    'updated_at' => '2023-08-15 17:00:00.000',
                ),
            11 =>
                array (
                    'id' => 12,
                    'device_id' => 21,
                    'detection_time' => '2023-08-19 16:30:00.000',
                    'recovery_time' => '2023-08-19 19:30:00.000',
                    'cause' => 'Đứt dây mạng',
                    'solution' => 'Nối lại dây',
                    'type_id' => 4,
                    'created_at' => '2023-08-19 17:00:00.000',
                    'updated_at' => '2023-08-19 17:00:00.000',
                ),
            12 =>
                array (
                    'id' => 13,
                    'device_id' => 26,
                    'detection_time' => '2023-08-19 10:00:00.000',
                    'recovery_time' => null,
                    'cause' => 'Lỗi mắt cam',
                    'solution' => 'Nhờ IT nhà máy hỗ trợ',
                    'type_id' => 9,
                    'created_at' => '2023-08-19 11:00:00.000',
                    'updated_at' => '2023-08-19 11:00:00.000',
                ),
            13 =>
                array (
                    'id' => 14,
                    'device_id' => 34,
                    'detection_time' => '2023-08-20 10:00:00.000',
                    'recovery_time' => null,
                    'cause' => 'Lỗi mắt cam',
                    'solution' => 'Nhờ IT nhà máy hỗ trợ',
                    'type_id' => 9,
                    'created_at' => '2023-08-20 11:00:00.000',
                    'updated_at' => '2023-08-20 11:00:00.000',
                ),
            14 =>
                array (
                    'id' => 15,
                    'device_id' => 4,
                    'detection_time' => '2023-08-21 10:00:00.000',
                    'recovery_time' => '2023-08-21 11:00:00.000',
                    'cause' => 'Chết cổng mạng',
                    'solution' => 'Thay switch mới',
                    'type_id' => 6,
                    'created_at' => '2023-08-21 11:00:00.000',
                    'updated_at' => '2023-08-21 11:00:00.000',
                ),
        ));
    }
}
