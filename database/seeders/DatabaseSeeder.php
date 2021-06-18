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
        // \App\Models\User::factory(10)->create();
        UserMembreship::factory(20)->create();
        // $this->call(UserMembreshipFactory::class);
        //$this->call(CountrySeeder::class);
        //$this->call(AccountTypeSeeder::class);
        //$this->call(DocumentTypeSeeder::class);
    }
}
