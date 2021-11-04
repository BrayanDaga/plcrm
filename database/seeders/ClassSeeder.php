<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clas;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clas::factory(20)->create();
    }
}
