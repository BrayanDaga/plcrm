<?php

namespace Database\Seeders;

use App\Models\AccountTypePointsMoney;
use Illuminate\Database\Seeder;

class AccountTypePoinstMoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valIni = 10;
        for ($i=1; $i < 5 ; $i++) { 
            AccountTypePointsMoney::create([
                'account_type_id' => $i,
                'points' => $valIni,
                'money' => $valIni -5,
            ]);
            $valIni += 5;
        }    
    }
}
