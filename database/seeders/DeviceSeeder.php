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
                    'ip' => '192.168.1.8',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 2,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Switch POE 1',
                    'position' => 'Cửa chuồng 2',
                    'ip' => null,
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 3,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Switch POE 2',
                    'position' => 'Cửa chuồng 5',
                    'ip' => null,
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 3,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Switch POE 3',
                    'position' => 'Cửa chuồng 10',
                    'ip' => null,
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 3,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Camera cổng chính 1',
                    'position' => 'Cổng chính',
                    'ip' => '192.168.1.215',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Camera cổng chính 2',
                    'position' => 'Cổng chính',
                    'ip' => '192.168.1.211',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Camera vào sát trùng',
                    'position' => 'Sân khu sinh hoạt',
                    'ip' => '192.168.1.222',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Camera kho cám 1',
                    'position' => 'Cửa kho cám 1',
                    'ip' => '192.168.1.210',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Camera ra sát trùng',
                    'position' => 'Cửa phòng tắm nam',
                    'ip' => '192.168.1.218',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Camera hành lang 1',
                    'position' => 'Hành lang chuồng 1',
                    'ip' => '192.168.1.249',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Camera sau chuồng',
                    'position' => 'Sau chuồng 1',
                    'ip' => '192.168.1.239',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Camera trên chuồng 1',
                    'position' => 'Chuồng thịt 1',
                    'ip' => '192.168.1.66',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Camera dưới chuồng 1',
                    'position' => 'Chuồng thịt 1',
                    'ip' => '192.168.1.229',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Camera trên chuồng 2',
                    'position' => 'Chuồng thịt 2',
                    'ip' => '192.168.1.227',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'Camera dưới chuồng 2',
                    'position' => 'Chuồng thịt 2',
                    'ip' => '192.168.1.212',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'Camera trên chuồng 3',
                    'position' => 'Chuồng thịt 3',
                    'ip' => '192.168.1.214',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'Camera dưới chuồng 3',
                    'position' => 'Chuồng thịt 3',
                    'ip' => null,
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'Camera trên chuồng 4',
                    'position' => 'Chuồng thịt 4',
                    'ip' => '192.168.1.223',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'Camera dưới chuồng 4',
                    'position' => 'Chuồng thịt 1',
                    'ip' => '192.168.1.225',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'Camera trên chuồng 5',
                    'position' => 'Chuồng thịt 5',
                    'ip' => '192.168.1.238',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'Camera dưới chuồng 5',
                    'position' => 'Chuồng thịt 5',
                    'ip' => '192.168.1.244',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'Camera trên chuồng 6',
                    'position' => 'Chuồng thịt 6',
                    'ip' => '192.168.1.226',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'Camera dưới chuồng 6',
                    'position' => 'Chuồng thịt 6',
                    'ip' => '192.168.1.213',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'Camera trên chuồng 7',
                    'position' => 'Chuồng thịt 7',
                    'ip' => '192.168.1.235',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'Camera dưới chuồng 7',
                    'position' => 'Chuồng thịt 7',
                    'ip' => '192.168.1.233',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'Camera trên chuồng 8',
                    'position' => 'Chuồng thịt 8',
                    'ip' => '192.168.1.216',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'Camera dưới chuồng 8',
                    'position' => 'Chuồng thịt 8',
                    'ip' => '192.168.1.236',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'Camera trên chuồng 9',
                    'position' => 'Chuồng thịt 9',
                    'ip' => '192.168.1.224',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'Camera dưới chuồng 9',
                    'position' => 'Chuồng thịt 9',
                    'ip' => '192.168.1.231',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'Camera trên chuồng 10',
                    'position' => 'Chuồng thịt 10',
                    'ip' => '192.168.1.2',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'Camera dưới chuồng 10',
                    'position' => 'Chuồng thịt 10',
                    'ip' => '192.168.1.228',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'Camera hành lang 2',
                    'position' => 'Hành lang chuồng 10',
                    'ip' => '192.168.1.65',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'Camera kho cám 2',
                    'position' => 'Cửa kho cám 2',
                    'ip' => '192.168.1.221',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'Camera cổng phụ',
                    'position' => 'Cổng phụ',
                    'ip' => '192.168.1.237',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
            35 =>
                array (
                    'id' => 36,
                    'name' => 'Camera bán heo',
                    'position' => 'Cầu cân điện tử',
                    'ip' => '192.168.1.221',
                    'status' => 'ON',
                    'farm_id' => 6,
                    'device_category_id' => 1,
                    'created_at' => '2023-05-15 07:01:43.000',
                    'updated_at' => '2023-05-15 07:01:43.000',
                ),
        ));
    }
}
