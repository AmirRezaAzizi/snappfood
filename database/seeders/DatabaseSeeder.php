<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Agent\Database\Seeders\AgentDatabaseSeeder;
use Modules\Order\Database\Seeders\OrderDatabaseSeeder;
use Modules\Trip\Database\Seeders\TripDatabaseSeeder;
use Modules\Vendor\Database\Seeders\VendorDatabaseSeeder;

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
