<?php

namespace Database\Seeders;

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

        DB::table('user_membreships')->insert([
            'user' => 'admin',
            'password' => $password ?: $password = bcrypt('admin'),
            'name' => 'Administrator',
            'last_name' => 'Promolider',
            'phone' => '999999999',
            'date_birth' => '1990-05-01',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'id_country' => rand(1, 50),
            'id_document_type' => rand(1, 4),
            'nro_document' => '1111111111',
            'id_account_type' => rand(1, 4),
            'request' => 1
        ]);

        DB::table('user_membreships')->insert([
            'user' => 'admin-wiliam',
            'password' => $password ?: $password = bcrypt('admin'),
            'name' => 'Wiliam',
            'last_name' => 'Ramirez',
            'phone' => '999999999',
            'date_birth' => '1990-05-01',
            'email' => 'wiliam@gmail.com',
            'id_referrer_sponsor' => 0,
            'id_country' => rand(1, 50),
            'id_document_type' => rand(1, 4),
            'nro_document' => '1111111111',
            'id_account_type' => rand(1, 4),
            'request' => 1
        ]);

        DB::table('user_membreships')->insert([
            'user' => 'user-jesus',
            'password' => $password ?: $password = bcrypt('admin'),
            'name' => 'Jesus',
            'last_name' => 'Paredes',
            'phone' => '999999999',
            'date_birth' => '1990-05-01',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'id_country' => rand(1, 50),
            'id_document_type' => rand(1, 4),
            'nro_document' => '1111111111',
            'id_account_type' => rand(1, 4),
            'request' => 1
        ]);

        DB::table('user_membreships')->insert([
            'user' => 'user-miguel',
            'password' => $password ?: $password = bcrypt('admin'),
            'name' => 'Miguel',
            'last_name' => 'Garcia',
            'phone' => '999999999',
            'date_birth' => '1990-05-01',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'id_country' => rand(1, 50),
            'id_document_type' => rand(1, 4),
            'nro_document' => '1111111111',
            'id_account_type' => rand(1, 4),
            'request' => 1
        ]);

        \App\Models\UserMembreship::factory([
            'user' => 'user-brayan',
            'name' => 'Brayan',
            'last_name' => 'Vilchez Daga',
            'email' => 'brayan@gmail.com',
            'id_referrer_sponsor' => 1,
        ])->create();
    }
}
