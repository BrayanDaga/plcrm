<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_membreship')->unsigned();
            $table->foreign('id_user_membreship')->references('id')->on('user_membreships');
            $table->integer('id_user_sponsor')->unsigned();
            $table->foreign('id_user_sponsor')->references('id')->on('user_membreships');
            $table->string('description', 50);
            $table->double('amount', 10, 2);
            $table->string('operation_number', 30);
            $table->integer('id_payment_method')->unsigned();
            $table->foreign('id_payment_method')->references('id')->on('payment_method');
            $table->integer('id_bank')->unsigned();
            $table->foreign('id_bank')->references('id')->on('bank');
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
        Schema::dropIfExists('payments');
    }
}
