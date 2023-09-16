<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FarmSeeder::class,
            AdminsTableSeeder::class,
            //UsersTableSeeder::class,
            DeviceCategorySeeder::class,
            //DeviceSeeder::class,
            ErrorTypeSeeder::class,
            //ErrorSeeder::class,
            //DeviceLogSeeder::class
        ]);
    }
}
