<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopingCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoping_cart_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shoping_cart_id')->unsigned();
            $table->bigInteger('courses_id')->unsigned();
            $table->timestamps();
            $table->foreign('shoping_cart_id')->references('id')->on('shoping_cart');
            $table->foreign('courses_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoping_cart_details');
    }
}
