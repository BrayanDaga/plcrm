<?php

namespace Database\Seeders;

use App\FunctionsSeeder;
use App\Models\Classified;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\BankSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CountrySeeder;
use Database\Seeders\PaymentSeeder;
use Database\Seeders\ClassifiedSeeder;
use Database\Seeders\AccountTypeSeeder;
use Database\Seeders\DocumentTypeSeeder;
use Database\Seeders\AdvertisementSeeder;
use Database\Seeders\PaymentMethodSeeder;
use Database\Seeders\UserMembreshipSeeder;
use Database\Seeders\AccountTypePoinstMoneySeeder;

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
         $this->call(UserSeeder::class);
      
        // $this->call(AdvertisementSeeder::class);
          $this->call(ClassifiedSeeder::class);
        // $this->call(WalletSeeder::class);
          $this->call(MessageSeeder::class);
          $this->call(FamilySeeder::class);
          $this->call(CategorySeeder::class);
          $this->call(CourseSeeder::class);
          $this->call(ModuleSeeder::class);
          $this->call(ClassSeeder::class);
            $this->call(PaymentSeeder::class);

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
            SELECT group_concat(id) INTO cid FROM users where FIND_IN_SET(id_referrer_sponsor, cid);   
        END WHILE;   
        RETURN str;   
        END
";

        DB::unprepared("DROP FUNCTION IF EXISTS GET_CHILD_NODE"); //borrando la funcion si existe
        DB::unprepared($getChildNodeFunction); //creando la funcion

        $getParentClassifiedNodeFunction = "
        CREATE FUNCTION `GET_PARENTCLASSIFIED_NODE`(rootId varchar(100))   
            RETURNS varchar(1000)   
            BEGIN   
            DECLARE fid varchar(100) default '';   
            DECLARE str varchar(1000) default rootId;   
            
            WHILE rootId is not null do   
                SET fid =(SELECT id_user_sponsor FROM classified WHERE user_id = rootId);   
                IF fid is not null THEN   
                    SET str = concat(str, ',', fid);   
                    SET rootId = fid;   
                ELSE   
                    SET rootId = fid;   
                END IF;   
            END WHILE;   
            return str;  
            END";

            DB::unprepared("DROP FUNCTION IF EXISTS GET_PARENTCLASSIFIED_NODE"); //borrando la funcion si existe
            DB::unprepared($getParentClassifiedNodeFunction); //creando la funcion */
    }
}
