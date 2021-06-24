<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembreshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_membreships', function (Blueprint $table) {
            $table->id();
            $table->string('user', 20);
            $table->string('password');
            $table->string('name', 30);
            $table->string('last_name', 50);
            $table->string('phone', 12);
            $table->date('date_birth');
            $table->string('email', 50);
            $table->integer('id_referrer_sponsor');
            $table->bigInteger('id_country')->unsigned();
            $table->foreign('id_country')->references('id')->on('country');
            $table->bigInteger('id_document_type')->unsigned();
            $table->foreign('id_document_type')->references('id')->on('document_type');
            $table->bigInteger('id_account_type')->unsigned();
            $table->foreign('id_account_type')->references('id')->on('account_type');
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
        Schema::dropIfExists('user_membreships');
    }
}
