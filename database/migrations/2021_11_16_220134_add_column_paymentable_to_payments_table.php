<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPaymentableToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // $table->morphs('paymentable');
            $table->unsignedInteger("paymentable_id")->after('user_id');
            $table->string("paymentable_type")->after('paymentable_id');
            $table->index(["paymentable_id", "paymentable_type"]);

            $table->dropForeign('payments_id_user_sponsor_foreign');
            $table->dropColumn('id_user_sponsor');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropMorphs('paymentable');
        });
    }   
}
