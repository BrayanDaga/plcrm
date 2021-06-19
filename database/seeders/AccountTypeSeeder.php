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
        $accounts = array('Account I','Account II','Account III','Account IV','Account V');
        //

        foreach ($accounts as $account){
            DB::table('account_type')->insert([
                'account' => $account,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
