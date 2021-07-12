<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumRequestUserMembreship extends Migration
{
    public function up()
    {
        Schema::table('user_membreships', function (Blueprint $table) {
            $table->string('request', 1)->default('0');
        });
    }
}
