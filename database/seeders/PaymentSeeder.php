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
        //Crear 30 payments con relacionado con 3 productos (pivote) con cantidad 4
        Payment::factory()->times(30)
        ->hasAttached(
            Product::factory()->count(3),
            ['quantity' => 4]
        )
        ->create();    
    }
}
