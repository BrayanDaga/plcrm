<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    public function run()
    {
        $accounts = array('Admin', 'School', 'Academy', 'University', 'Invited');

        foreach ($accounts as $account) {
            DB::table('account_type')->insert([
                'account' => $account,
                'status' => 1,
                'price' => 15.36,
                // 'commission' => 56.36,
                // 'discount' => 0.0,
                // 'profit' => 36.6,
                // 'profit_2' => 36.6,
                // 'percentage' => 0.6,
                // 'court_pay_percentage' => 36.65,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
        }

        // Actualizando el estado el tipo de cuenta "admin" a 0
        DB::table('account_type')
        ->where('id', 1)
        ->update(['status' => 0]);
    }
}
