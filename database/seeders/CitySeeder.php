<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Nador', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Al Hoceima', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Jebha', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'M\'diq', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tanger', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Larache', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kénitra', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mohammedia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Casablanca', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'El Jadida', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'El Safi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'El Essaouira', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Agadir', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Ifni', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tantan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Laayoune', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Boujdour', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dakhla', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]

        ];

        DB::table('cities')->insert($cities);
    }
}
