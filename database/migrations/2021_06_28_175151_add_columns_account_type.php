<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAccountType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_type', function (Blueprint $table) {
            $table->double('price', 10, 2);
            $table->double('commissionable', 10, 2);
            $table->string('commissionable_status', 1)->default('0');
            $table->double('iva', 10, 2)->default('0.18');
            $table->integer('group')->default('0');
            $table->double('discount', 10, 2);
            $table->double('court_pay_percentage', 10, 2);
            $table->double('profit', 10, 2)->comment('ganancia de la venta');
            $table->double('profit_2', 10, 2)->comment('ganancia de la venta');
            $table->double('percentage', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
