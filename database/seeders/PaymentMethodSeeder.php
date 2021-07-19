<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $paymentMethods = array('Paypal', 'Pago Efectivo', 'Targeta de Credito');

        foreach ($paymentMethods as $paymentMethod) {
            DB::table('payment_method')->insert([
                'name' => $paymentMethod,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
