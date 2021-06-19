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
        $documents = array('DNI','PASAPORTE','CARNET DE EXTRANJERIA', 'OTROS');

        foreach ($documents as $document){
            DB::table('document_type')->insert([
                'document' => $document,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
