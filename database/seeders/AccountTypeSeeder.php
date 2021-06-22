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
        $accounts = array('School', 'Academy', 'University', 'Invited');
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
