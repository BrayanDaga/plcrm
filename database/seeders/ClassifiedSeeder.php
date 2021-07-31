<?php

namespace Database\Seeders;

use App\Models\Classified;
use App\Models\UserMembreship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassifiedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = UserMembreship::all()->count();
        for ($i=1; $i <= $count; $i++) { 
            Classified::factory()->count(2)->create([
                'id_user_sponsor' => $i
            ]);
        }

    }
}
