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
            $table->bigInteger('id_document_type');
            $table->string('name', 30);
            $table->string('last_name', 50);
            $table->date('date_birth');
            $table->string('phone', 12);
            $table->bigInteger('country');
            $table->string('email', 50);
            $table->string('user', 20);
            $table->string('password');
            $table->string('referrer_sponsor');
            $table->bigInteger('id_account_type');
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
