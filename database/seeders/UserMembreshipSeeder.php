<?php

namespace Database\Seeders;

use App\Models\Classified;
use App\Models\Payment;
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
            'request' => 2,
            'expiration_date' => strtotime('+10 years'),
            'id_account_type' => 1,
            // 'created_at' => strtotime('-1 years'),
        ]);

        //Los siguientes usuarios tienen un pago
        UserMembreship::factory([
            'user' => 'admin-wiliam',
            'name' => 'Wiliam',
            'last_name' => 'Ramirez',
            'email' => 'wiliam@gmail.com',
            'id_referrer_sponsor' => 1,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory(['id_user_sponsor' => 1]))->create();

        UserMembreship::factory([
            'user' => 'user-jesus',
            'name' => 'Jesus',
            'last_name' => 'Paredes',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 1,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 3,
        ])->has(Payment::factory(['id_user_sponsor' => 1]))->create();

        UserMembreship::factory([
            'user' => 'user-miguel',
            'name' => 'Miguel',
            'last_name' => 'Garcia',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 1,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 4,
        ])->has(Payment::factory(['id_user_sponsor' => 1]))->create();

        UserMembreship::factory([
            'user' => 'user-brayan',
            'name' => 'Brayan',
            'last_name' => 'Vilchez Daga',
            'email' => 'brayan@gmail.com',
            'id_referrer_sponsor' => 1,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => 1]))->create();


        UserMembreship::factory([
            'id_referrer_sponsor' => 1,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->count(4)->has(Payment::factory([ 'id_user_sponsor' => 1]))->create();

   
        UserMembreship::factory([
            'id_referrer_sponsor' => 2,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->count(4)->has(Payment::factory([ 'id_user_sponsor' => 2]))->create();


        UserMembreship::factory([
            'id_referrer_sponsor' => 5,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->count(4)->has(Payment::factory([ 'id_user_sponsor' => 5]))->create();

        UserMembreship::factory([
            'id_referrer_sponsor' => 6,
            'request' => 1,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->count(4)->has(Payment::factory([ 'id_user_sponsor' => 6]))->create();

        // for ($i = 0; $i < 2; $i++) {
        //     //No activos por fecha de expiracion
        //     UserMembreship::factory([
        //         'id_referrer_sponsor' => 1,
        //         'expiration_date' => now()
        //     ])->has(Classified::factory(['id_user_sponsor' => 1]))->create();

        //     //Activo por fecha de expiracion
        //     UserMembreship::factory([
        //         'id_referrer_sponsor' => 1,
        //     ])->has(Classified::factory(['id_user_sponsor' => 1]))->create();
        // }
    }
}
