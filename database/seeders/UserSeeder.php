<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::factory([
            'username' => 'admin',
            'name' => 'Administrator',
            'last_name' => 'Promolider',
            'email' => 'admin@promolider.test',
            'id_referrer_sponsor' => 0,
            'request' => 3,
            'expiration_date' => strtotime('+10 years'),
            'id_account_type' => 1,
             'created_at' => strtotime('-1 years'),
             'type_user' => 0
        ])->has(Wallet::factory(['status'=>2]))
        ->create();
        //Ahora el estado del registro de billetera es 3 q significa que es despues de un corte binario

          $user2 = User::factory([
              'username' => 'user-brayan',
              'name' => 'Brayan',
              'last_name' => 'Vilchez Daga',
              'email' => 'bryan@gmail.com',
              'id_referrer_sponsor' => $user1->id,
              'request' => 2,
             'expiration_date' => strtotime('+30 days'),
              'id_account_type' => 2,
              'type_user' => 1
          ])->hasPaymentsClient(Payment::factory([ 'id_user_sponsor' => $user1->id]))
          ->has(Wallet::factory(['status'=>2]))
          ->create();

        $user3 = User::factory([
            'username' => 'admin-wiliam',
            'name' => 'Wiliam',
            'last_name' => 'Ramirez',
            'email' => 'wiliam@gmail.com',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
            'type_user' => 1
        ])->hasPaymentsClient(Payment::factory(['id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory(['status'=>2]))
        ->create();

        $user4 = User::factory([
            'username' => 'user-jesus',
            'name' => 'Jesus',
            'last_name' => 'Paredes',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 3,
            'type_user' => 1
        ])->hasPaymentsClient(Payment::factory(['id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory(['status'=>2]))
        ->create();


        $user4 = User::factory([
            'username' => 'user-miguel',
            'name' => 'Miguel',
            'last_name' => 'Garcia',
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 4,
            'type_user' => 1
        ])->hasPaymentsClient(Payment::factory(['id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory(['status'=>2]))
        ->create();

        $user6 = User::factory([
            'id_referrer_sponsor' => $user1->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->hasPaymentsClient(Payment::factory([ 'id_user_sponsor' => $user1->id]))
        ->has(Wallet::factory(['status'=>2]))
        ->create();

        User::factory([
            'id_referrer_sponsor' => $user3->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->hasPaymentsClient(Payment::factory([ 'id_user_sponsor' => $user3->id]))
        ->has(Wallet::factory(['status'=>2]))
        ->create();


        User::factory([
            'id_referrer_sponsor' => $user2->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->hasPaymentsClient(Payment::factory([ 'id_user_sponsor' => $user2->id]))
        ->has(Wallet::factory(['status'=>2]))
        ->create();

        User::factory([
            'id_referrer_sponsor' => $user6->id,
            'request' => 2,
            'expiration_date' => strtotime('+30 days'),
            'id_account_type' => 2,
        ])->hasPaymentsClient(Payment::factory([ 'id_user_sponsor' => $user4->id]))
        ->create();

    }
}
