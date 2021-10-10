<?php

namespace Database\Seeders;

use App\Models\Wallet;
use App\Models\Payment;
use App\Models\Classified;
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
        $user1 = UserMembreship::factory([
            'user' => 'admin',
            'name' => 'Administrator',
            'last_name' => 'Promolider',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'request' => 3,
            'expiration_date' => strtotime('+10 years'),
            'id_account_type' => 1,
             'created_at' => strtotime('-1 years'),
        ])->has(Wallet::factory())
        ->create();

          $user2 = UserMembreship::factory([
              'user' => 'user-brayan',
              'name' => 'Brayan',
              'last_name' => 'Vilchez Daga',
              'email' => 'bryan@gmail.com',
              'id_referrer_sponsor' => $user1->id,
              'request' => 2,
             'expiration_date' => strtotime('+30 days'),
              'id_account_type' => 2,
          ])->has(Payment::factory([ 'id_user_sponsor' => $user1->id]))
          ->has(Wallet::factory())
          ->create();

        $user3 = UserMembreship::factory([
            'user' => 'admin-wiliam',
            'name' => 'Wiliam',
            'last_name' => 'Ramirez',
            'email' => 'wiliam@gmail.com',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory(['id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory())
        ->create();

        $user4 = UserMembreship::factory([
            'user' => 'user-jesus',
            'name' => 'Jesus',
            'last_name' => 'Paredes',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 3,
        ])->has(Payment::factory(['id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory())
        ->create();

        $user4 = UserMembreship::factory([
            'user' => 'user-miguel',
            'name' => 'Miguel',
            'last_name' => 'Garcia',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 4,
        ])->has(Payment::factory(['id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory())
        ->create();

        $user6 = UserMembreship::factory([
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory())
        ->create();

        UserMembreship::factory([
            'id_referrer_sponsor' => $user3->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user3->id]))
        ->has(Wallet::factory())
        ->create();


        UserMembreship::factory([
            'id_referrer_sponsor' => $user2->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user2->id]))
        ->has(Wallet::factory())
        ->create();

        UserMembreship::factory([
            'id_referrer_sponsor' => $user6->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->has(Payment::factory([ 'id_user_sponsor' => $user4->id]))
        ->create();

        
    }
}
