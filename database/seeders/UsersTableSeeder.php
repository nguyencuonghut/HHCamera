<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Trại heo Ba Vì',
                    'email' => 'thbavi@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'farm_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Trại heo Đoan Hạ',
                    'email' => 'thdoanha@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'farm_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Trại heo Cầu Trâm',
                    'email' => 'thcautram@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'farm_id' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Trại heo Xích Thổ',
                    'email' => 'thxichtho@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'farm_id' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Trại heo Kỳ Bắc 1',
                    'email' => 'thkybac1@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'farm_id' => 5,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Trại heo Tiến Đức',
                    'email' => 'thtienduc@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'farm_id' => 6,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
        ));
    }
}
