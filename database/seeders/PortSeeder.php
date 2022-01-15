<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ports = [
            ['name' => 'Nador Port', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ras Kebdana', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Hsaine', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Martchika', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Chamlala', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ifri Ifounassen', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ahdid', 'city_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Al Hoceima Port', 'city_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Inouarane', 'city_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kalairis', 'city_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Jebha Port', 'city_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Chmaala', 'city_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Amtar', 'city_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Targha', 'city_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kaa Asrass', 'city_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'M\'diq Port', 'city_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Findeq', 'city_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Martil', 'city_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Oued Laou', 'city_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Belyounech', 'city_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tanger Port', 'city_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dalia', 'city_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Assila', 'city_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ksar Sghir', 'city_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Larache Port', 'city_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mehdia Port', 'city_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Moulay Bousselham', 'city_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Rabat/Salé', 'city_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Skhirat', 'city_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mohammedia Port', 'city_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bouznika', 'city_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Essanaoubar', 'city_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Casablanca Port', 'city_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tamaris', 'city_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Rahal', 'city_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'El Jadida Port', 'city_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lahdida', 'city_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'El Jorf', 'city_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sid Abed', 'city_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Oualidia', 'city_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Safi Port', 'city_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Souiria Lakdima', 'city_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Essaouira Port', 'city_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cap Sim', 'city_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Labhibeh', 'city_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tafdna', 'city_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Agadir Port', 'city_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tifnit', 'city_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Immessouane', 'city_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Taghazout', 'city_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Immi Ouaddar', 'city_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Imourane', 'city_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Ifni Port', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Gourizim', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Aglou', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Boulfdail', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Aguejgal', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'R\'kount', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Ouarzeg', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Ali Jama', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Oued Noun', 'city_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tantan port', 'city_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Oued Chbika', 'city_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Rass Oumlil', 'city_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ben Khlil', 'city_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Oued Ouaar', 'city_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Akhfennir', 'city_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Laayoune Port', 'city_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Khnifiss', 'city_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tarouma', 'city_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tarfaya', 'city_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Amegriou', 'city_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Boujdour Port', 'city_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sidi Elghazi', 'city_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Aftissat', 'city_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lakraa', 'city_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lassarga', 'city_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ntireft', 'city_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lbouirda', 'city_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lamhiriz', 'city_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Imoutlane', 'city_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ain Beida', 'city_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];

        DB::table('ports')->insert($ports);
    }
}
