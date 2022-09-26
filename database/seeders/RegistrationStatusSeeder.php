<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registration_statues = [
            ['name' => 'New'],
            ['name' => 'Replacement'],
            ['name' => 'Radiation'],
            ['name' => 'Change of beacon or owner information']
        ];

        DB::table('registration_statuses')->insert($registration_statues);
    }
}
