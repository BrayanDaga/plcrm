<?php

namespace Database\Seeders;

use App\Models\UserMembreship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMembreshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $password;

        UserMembreship::factory()->create([
            'user' => 'admin',
            'name' => 'Administrator',
            'last_name' => 'Promolider',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'request' => 1
        ]);

        UserMembreship::factory()->create([
            'user' => 'admin',
            'name' => 'Administrator',
            'last_name' => 'Promolider',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'request' => 1
        ]);

        UserMembreship::factory()->create([
            'user' => 'admin-wiliam',
            'name' => 'Wiliam',
            'last_name' => 'Ramirez',
            'email' => 'wiliam@gmail.com',
            'id_referrer_sponsor' => 0,
            'request' => 1
        ]);

        UserMembreship::factory()->create([
            'user' => 'user-jesus',
            'name' => 'Jesus',
            'last_name' => 'Paredes',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'request' => 1
        ]);

        UserMembreship::factory()->create([
            'user' => 'user-miguel',
            'name' => 'Miguel',
            'last_name' => 'Garcia',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'request' => 1
        ]);

        UserMembreship::factory()->create([
            'user' => 'user-brayan1',
            'name' => 'Brayan',
            'last_name' => 'Vilchez Daga',
            'email' => 'brayan@gmail.com',
            'id_referrer_sponsor' => 1,
            'request' => 1
        ]);


        //crear 15 usuarios con sus respectivas billeteras referidas al usuario 1
        // \App\Models\UserMembreship::factory([
        //     'id_referrer_sponsor' => 1,
        // ])->has(\App\Models\Wallet::factory())->count(15)->create();

    }
}
