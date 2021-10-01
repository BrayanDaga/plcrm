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

        $user1 = UserMembreship::factory()->create([
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

        $user2 = UserMembreship::factory([
            'user' => 'user-brayan',
            'name' => 'Brayan',
            'last_name' => 'Vilchez Daga',
            'email' => 'bryan@gmail.com',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user1->id]))->create();

        //Los siguientes usuarios tienen un pago
        $user3 = UserMembreship::factory([
            'user' => 'admin-wiliam',
            'name' => 'Wiliam',
            'last_name' => 'Ramirez',
            'email' => 'wiliam@gmail.com',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory(['id_user_sponsor' => $user1->id]))->create();

        $user4 = UserMembreship::factory([
            'user' => 'user-jesus',
            'name' => 'Jesus',
            'last_name' => 'Paredes',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 3,
        ])->has(Payment::factory(['id_user_sponsor' => $user1->id]))->create();

        $user4 = UserMembreship::factory([
            'user' => 'user-miguel',
            'name' => 'Miguel',
            'last_name' => 'Garcia',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 4,
        ])->has(Payment::factory(['id_user_sponsor' => $user1->id]))->create();

        


        $user6 = UserMembreship::factory([
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user1->id]))->create();

        UserMembreship::factory([
            'id_referrer_sponsor' => $user3->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user3->id]))->create();


        UserMembreship::factory([
            'id_referrer_sponsor' => $user2->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user2->id]))->create();

        UserMembreship::factory([
            'id_referrer_sponsor' => $user6->id,
            'request' => 2,
            // 'created_at' => strtotime('-1 years'),
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user4->id]))->create();

        // for ($i = 0; $i < 2; $i++) {
        //     //No activos por fecha de expiracion
        //     UserMembreship::factory([
        //         'id_referrer_sponsor' => $user1->id,
        //         'expiration_date' => now()
        //     ])->has(Classified::factory(['id_user_sponsor' => $user1->id]))->create();

        //     //Activo por fecha de expiracion
        //     UserMembreship::factory([
        //         'id_referrer_sponsor' => $user1->id,
        //     ])->has(Classified::factory(['id_user_sponsor' => $user1->id]))->create();
        // }
    }
}
