<?php
namespace Database\Seeders;

use App\Models\Course;
use App\Models\Payment;
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
        $payment1 = Payment::factory()->create();
        $payment2 = Payment::factory()->create();
        $payment1->courses()->syncWithoutDetaching(Course::inRandomOrder()->first()->id);
        $payment2->courses()->syncWithoutDetaching(Course::inRandomOrder()->first()->id);
    }
}

