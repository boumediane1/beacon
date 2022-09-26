<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            ['name' => 'MT410G', 'type_id' => 1],
            ['name' => 'MT400', 'type_id' => 1],
            ['name' => 'MT401', 'type_id' => 1],
            ['name' => 'MT400G', 'type_id' => 1],
            ['name' => 'MT401G', 'type_id' => 1],
            ['name' => 'MT401FF', 'type_id' => 1],
            ['name' => 'MT401FG', 'type_id' => 1],
            ['name' => 'MT406G', 'type_id' => 1],
            ['name' => 'MT403', 'type_id' => 1],
            ['name' => 'MT600G', 'type_id' => 1],
            ['name' => 'MT603FG', 'type_id' => 1],
            ['name' => 'MT603G', 'type_id' => 1],
            ['name' => 'MT610G', 'type_id' => 1],

            ['name' => 'FastFind 210 GPS', 'type_id' => 2],
            ['name' => 'SmartFind Plus G5', 'type_id' => 2],
            ['name' => 'SmartFind E5', 'type_id' => 2],
            ['name' => 'SmartFind E8', 'type_id' => 2],
            ['name' => 'SmartFind G8', 'type_id' => 2],
            ['name' => 'SmartFind G8 AIS', 'type_id' => 2],


            ['name' => 'FastFind Return Link', 'type_id' => 1],

            ['name' => 'PLB-375', 'type_id' => 1],
            ['name' => 'PLB-425', 'type_id' => 1],
            ['name' => 'PLB-350B', 'type_id' => 1],
            ['name' => 'PLB-350C', 'type_id' => 1],
            ['name' => 'PLB-400', 'type_id' => 1],
            ['name' => 'PLB-410', 'type_id' => 1],
            ['name' => 'PLB-435', 'type_id' => 1],
            ['name' => 'RLB-3 6', 'type_id' => 1],
            ['name' => 'RLB-3 7', 'type_id' => 1],
            ['name' => 'RLB-3 8', 'type_id' => 1],
            ['name' => 'RLB-4 0', 'type_id' => 1],
            ['name' => 'GLOBALFIX V4', 'type_id' => 1],

            ['name' => 'RescueME PLB1', 'type_id' => 1],
            ['name' => 'SafeSea E100', 'type_id' => 1],
            ['name' => 'SafeSea E100G', 'type_id' => 1],

            ['name' => 'SAILOR 4065', 'type_id' => 1],

            ['name' => 'JQE-103', 'type_id' => 1],

            ['name' => 'Tron 405 MkII', 'type_id' => 1],

            ['name' => 'W100', 'type_id' => 1],
            ['name' => 'W200 V4', 'type_id' => 1],

            ['name' => 'SEP-500', 'type_id' => 1]
        ];

        DB::table('models')->insert($models);
    }
}
