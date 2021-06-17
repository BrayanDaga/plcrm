<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembreshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membreship', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_membreship')->unsigned();
            $table->foreign('id_user_membreship')->references('id')->on('user_membreships');
            $table->integer('id_account_type')->unsigned();
            $table->foreign('id_account_type')->references('id')->on('account_type');
            $table->string('position', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membreship');
    }
}
