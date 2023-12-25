<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeaconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 'status => true
     */
    public function run()
    {
        $beacons = [
            [
                'uin' => '1E4E9763A8FFBFF',
                'serial_number' => '2103388116',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYear(),
                'status' => true
            ],
            [
                'uin' => '1E4E9763A6FFBFF',
                'serial_number' => '2103387763',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(7),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF4FFBFF',
                'serial_number' => '2104387706',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(5),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF6FFBFF',
                'serial_number' => '2104388018',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(4),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF8FFBFF',
                'serial_number' => '2104387801',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(7),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF9FFBFF',
                'serial_number' => '2104397801',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(3),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF1FFBFF',
                'serial_number' => '2104497801',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(2),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF2FFBFF',
                'serial_number' => '2104597801',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(6),
                'status' => true
            ],
            [
                'uin' => '1E4E976AF3FFBFF',
                'serial_number' => '2104697801',
                'model_id' => 1,
                'manufacturer_id' => 1,
                'registration_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addYears(7),
                'status' => true
            ],
        ];

        DB::table('beacons')->insert($beacons);


    }
}
