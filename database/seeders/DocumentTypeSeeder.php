<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('document_type')->insert([
            'document' => 'DNI',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('document_type')->insert([
            'document' => 'PASAPORTE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('document_type')->insert([
            'document' => 'CARNET DE EXTRANJERIA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('document_type')->insert([
            'document' => 'OTROS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
