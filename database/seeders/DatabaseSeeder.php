<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AgentDatabaseSeeder;
use Database\Seeders\OrderDatabaseSeeder;
use Database\Seeders\TripDatabaseSeeder;
use Database\Seeders\VendorDatabaseSeeder;

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
            VendorDatabaseSeeder::class,
            AgentDatabaseSeeder::class,
            OrderDatabaseSeeder::class,
            TripDatabaseSeeder::class,
        ]);
    }
}
