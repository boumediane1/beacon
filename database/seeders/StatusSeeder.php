<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statues = [
            ['name' => 'Active'],
            ['name' => 'Inactive'],
            ['name' => 'Lost'],
            ['name' => 'Canceled'],
            ['name' => 'Destroyed'],
            ['name' => 'Replaced'],
            ['name' => 'Sold']
        ];

        DB::table('statuses')->insert($statues);
    }
}
