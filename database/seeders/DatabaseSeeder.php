<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use App\Models\UnitType;
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
//         \App\Models\User::factory(10)->create();
        $this->call([
            CountrySeeder::class,
            UserSeeder::class,
            CitySeeder::class,
            PortSeeder::class,
            ActivitySeeder::class,
            UnitTypeSeeder::class,
            TypeSeeder::class,
            ModelSeeder::class,
            ManufacturerSeeder::class,
            StatusSeeder::class,
            RegistrationStatusSeeder::class,
        ]);
    }
}
