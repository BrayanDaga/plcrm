<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBonusesToClassifiedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classified', function (Blueprint $table) {
            $table->unsignedDouble('growth_bonus',10,2)->default(0.0);
            $table->unsignedDouble('starting_bonus',10,2)->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classified', function (Blueprint $table) {
            $table->dropColumn('growth_bonus');
            $table->dropColumn('starting_bonus');
        });
    }
}
