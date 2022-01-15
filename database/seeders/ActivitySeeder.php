<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            ['name' => 'Fishing vessel'],
            ['name' => 'Pleasure vessel'],
            ['name' => 'Merchant navy'],
            ['name' => 'Air unit'],
            ['name' => 'Land unit']

        ];

        DB::table('activities')->insert($activities);
    }
}
