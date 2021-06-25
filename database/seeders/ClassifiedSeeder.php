<?php

namespace Database\Seeders;

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

        /**
         * se estan cambiando algunos valos con fines de generar menos datos de prueba
         */

        for ($index = 0; $index < 5; $index++){
            $id = rand(1, 4);
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
