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
            ['name' => 'Laayoune', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Boujdour', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dakhla', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        DB::table('cities')->insert($cities);
    }
}
