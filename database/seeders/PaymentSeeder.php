<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($index = 0; $index < 30; $index++){
            $amount = rand(1500, 6868);
            $operations = rand(1500, 6868);
            $paymentMethod = rand(1, 3);
            $id = rand(1, 4);
            DB::table('payments')->insert([
                'id_user_membreship' => $id,
                'id_user_sponsor' => $id,
                'description' => 'description',
                'amount' => $amount,
                'operation_number' => (string)$operations,
                'id_payment_method' => $paymentMethod,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
