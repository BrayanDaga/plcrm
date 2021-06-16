<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAccountTypeByUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_account_type_by_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_membreship');
            $table->bigInteger('id_account_type');
            $table->double('prince');
            $table->integer('igv');
            $table->double('total');
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
        Schema::dropIfExists('table_account_type_by_user');
    }
}
