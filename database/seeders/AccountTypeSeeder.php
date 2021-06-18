<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('account_type')->insert([
            'account' => 'CuentaI',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('account_type')->insert([
            'account' => 'CuentaII',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('account_type')->insert([
            'account' => 'CuentaIII',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
