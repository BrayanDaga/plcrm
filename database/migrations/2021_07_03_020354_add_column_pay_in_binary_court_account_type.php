<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPayInBinaryCourtAccountType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_type', function (Blueprint $table) {
            $table->unsignedInteger('pay_in_binary',)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_type', function (Blueprint $table) {
            $table->dropColumn('pay_in_binary');
        });
    }
}
