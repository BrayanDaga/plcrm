<?php

namespace Database\Seeders;

use App\Models\Classified;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassifiedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantUsers = User::all()->count();
        for ($i = 2; $i <= $cantUsers; $i++){
            $user = User::find($i);
            $position = (bool)random_int(0, 1);
            Classified::factory([
                'id_user_membreship' => $user->id,
                'id_user_sponsor' => $user->id_referrer_sponsor,
                'status_position_left' => $position,
                'status_position_right' => !$position,
            ])->create();
        }
    }
}
