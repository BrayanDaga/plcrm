<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_resources', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_course_video')->unsigned();
            $table->foreign('id_course_video')->references('id')->on('course_video');
            $table->bigInteger('id_lessons')->unsigned();
            $table->foreign('id_lessons')->references('id')->on('lessons');
            $table->longText('resource_file');
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
        Schema::dropIfExists('class_resources');
    }
}
