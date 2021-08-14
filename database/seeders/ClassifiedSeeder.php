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
        // $count = UserMembreship::all()->count();
        // for ($i=1; $i <= $count; $i++) { 
        //     Classified::factory()->count(2)->create([
        //         'id_user_sponsor' => $i
        // ]);

        for ($index = 0; $index < 4; $index++){
            $id = rand(2, 3);
            DB::table('classified')->insert([
                'id_user_membreship' => $id,
                'id_user_sponsor' => $id,
                'binary_sponsor' => 'test',
                'position' => '1',
                'classification' => 16,
                'status' => '0',
                'authorized' => '1',
                'status_position_left' => '1',
                'status_position_right' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('classified')->insert([
                'id_user_membreship' => $id + 1,
                'id_user_sponsor' => $id + 1,
                'binary_sponsor' => 'test 1',
                'position' => '2',
                'classification' => 26,
                'status' => '1',
                'authorized' => '0',
                'status_position_left' => '0',
                'status_position_right' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
