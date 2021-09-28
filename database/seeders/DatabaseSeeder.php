<?php

namespace Database\Seeders;

use App\FunctionsSeeder;
use App\Models\Classified;
use App\Models\UserMembreship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(AccountTypeSeeder::class);
        $this->call(AccountTypePoinstMoneySeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(BankSeeder::class);
        // UserMembreship::factory()->create(); // se reduce la cantida de datos de pruebas
         $this->call(UserMembreshipSeeder::class);
        // $this->call(PaymentSeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(ClassifiedSeeder::class);
        $this->call(WalletSeeder::class);
        /*$this->call(ClassifiedSeeder::class);*/

        /*creando function mysql para Obtener todos los nodos secundarios de un nodo
        mas info: https://programmerclick.com/article/13791419702/   */
        $getChildNodeFunction = "
        CREATE FUNCTION `GET_CHILD_NODE`(rootId varchar(100))   
        RETURNS varchar(2000)  
        BEGIN   
        DECLARE str varchar(2000);  
        DECLARE cid varchar(100);   
        SET str = '$';   
        SET cid = rootId;   
        WHILE cid is not null DO   
            SET str = concat(str, ',', cid);   
            SELECT group_concat(id) INTO cid FROM user_membreships where FIND_IN_SET(id_referrer_sponsor, cid);   
        END WHILE;   
        RETURN str;   
        END
";

        DB::unprepared("DROP FUNCTION IF EXISTS GET_CHILD_NODE"); //borrando la funcion si existe
        DB::unprepared($getChildNodeFunction); //creando la funcion

    }
}
