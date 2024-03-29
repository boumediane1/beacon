<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_types = [
            ['name' => 'Artisanal', 'activity_id' => 1],
            ['name' => 'Coastal', 'activity_id' => 1],
            ['name' => 'Offshore', 'activity_id' => 1]
        ];

        DB::table('unit_types')->insert($unit_types);
    }
}
