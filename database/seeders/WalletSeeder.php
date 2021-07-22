<?php

namespace Database\Seeders;

use App\Models\UserMembreship;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
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
            Wallet::factory()->create(['id_user_membreship' => $i]);
        }
    }
}
