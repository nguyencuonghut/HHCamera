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
                    'name' => 'Trại heo Ba Vì',
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
        ));
    }
}
