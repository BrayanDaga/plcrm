<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembreshipPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_membreship_payment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_membreship')->unsigned();
            $table->foreign('id_user_membreship')->references('id')->on('user_membreships');
            $table->bigInteger('id_payment')->unsigned();
            $table->foreign('id_payment')->references('id')->on('user_membreships');
            $table->string('authorizationCode', 6);
            $table->string('errorCode', 4);
            $table->integer('idCommerce', 4);
            $table->string('shippingCity', 50);
            $table->string('txDateTime', 20);
            $table->integer('purchaseOperationNumber', 6);
            $table->string('shippingAddress', 50);
            $table->string('card_account_type', 30);
            $table->string('answerMessage');
            $table->string('bank_description',30);
            $table->string('cuota',30);
            $table->string('paymentReferenceCode');
            $table->string('brand', 12);
            $table->text('purchaseVerification');
            $table->string('IDTransaction', 30);
            $table->string('errorMessage');
            $table->string('authorizationResult', 3);
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
        Schema::dropIfExists('user_membreship_payment');
    }
}
