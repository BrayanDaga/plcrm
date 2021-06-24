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
                'status' => $account,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
