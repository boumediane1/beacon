<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = [
            ['name' => 'GME'],
            ['name' => 'McMurdo'],
            ['name' => 'Orolia Limited'],
            ['name' => 'ACR'],
            ['name' => 'Ocean Signal'],
            ['name' => 'Cobham'],
            ['name' => 'JRC'],
            ['name' => 'Jotron'],
            ['name' => 'WamBlee'],
            ['name' => 'SAMYUNG ENC']

        ];

        DB::table('manufacturers')->insert($manufacturers);
    }
}
