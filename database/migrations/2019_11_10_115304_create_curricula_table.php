<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('program_id');
            $table->enum('term', ['semester', 'trimester', 'quarter']);
            $table->text('start_year');
            $table->text('end_year');
            $table->timestamps();
        });

        Schema::create('curriculum_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('course_id');
            $table->text('term');

            $table->foreign('curriculum_id')->references('id')->on('curriculum')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum');
        Schema::dropIfExists('curriculum_courses');
    }
}
