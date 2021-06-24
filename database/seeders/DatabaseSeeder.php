<?php

namespace Database\Seeders;

use App\Models\UserMembreship;
use Database\Factories\UserMembreshipFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(AccountTypeSeeder::class);
        UserMembreship::factory()->create(); // se reduce la cantida de datos de pruebas
        $this->call(ClassifiedSeeder::class);
    }
}
