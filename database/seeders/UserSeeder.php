<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin'),
                'role' => 1,
                'country_id' => 1,
            ]
        ];

        DB::table('users')->insert($users);
    }
}
