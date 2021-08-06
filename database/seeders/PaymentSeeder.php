<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Product;
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
        //Crear 35 payments con relacionado con 1 a 3 productos (pivote)
        Payment::factory()->times(35)
        ->hasAttached(
            Product::factory()->count(mt_rand(1,3)),
            ['quantity' => mt_rand(1,4)]
        )
        ->create();    
    }
}
