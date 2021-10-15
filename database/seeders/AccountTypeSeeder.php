<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    public function run()
    {
        $accounts = array('Admin', 'School', 'Academy', 'University', 'Invited');

        foreach ($accounts as $account) {
            AccountType::create([
                'account' => $account,
                'price' => 100.00,
                'status' => 1,
                'iva'=>50.00,
                'disc_purchases'=>50.00,
                'pay_in_binary'=>50.00,
                'profit_on_purchases'=>50.00,
                'profit_on_purchases_2'=>50.00,
                'comission'=>  50.00
            ]);
        }

        // Actualizando el estado el tipo de cuenta "admin" a 0
         DB::table('account_type')
         ->where('id', 1)
         ->update(['status' => 0]);
        // AccountType::find(1)->update('status',0);
    }
}
