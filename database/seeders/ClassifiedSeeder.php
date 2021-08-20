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
        $i = 1; $j=1;
        for ($index = 0; $index < 4; $index++){
            $id = rand(2, 4);
            DB::table('classified')->insert([
                'id_user_membreship' => $id,
                'id_user_sponsor' => $i,
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
                'id_user_sponsor' => $i,
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

            $i++;
        }
    }
}
