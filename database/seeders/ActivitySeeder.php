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
            ['name' => 'Fishing'],
            ['name' => 'Pleasure'],
            ['name' => 'Merchant navy'],
            ['name' => 'Air unit'],
            ['name' => 'Land unit'],
            ['name' => 'Service'],
            ['name' => 'Military'],
            ['name' => 'SAR'],

        ];

        DB::table('activities')->insert($activities);
    }
}
