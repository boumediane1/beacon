<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
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
         \App\Models\User::factory(10)->create();
        $this->call([
            CitySeeder::class,
            PortSeeder::class,
            ActivitySeeder::class,
            TypeSeeder::class,
            ModelSeeder::class,
            ManufacturerSeeder::class,
            BeaconSeeder::class
        ]);
    }
}
