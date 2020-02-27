<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('term_name')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });

        Schema::create('terms_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('course_id');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });

        Schema::create('terms_courses_profs', function (Blueprint $table) {
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_Id');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('user_Id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
        Schema::dropIfExists('terms_courses');
        Schema::dropIfExists('terms_courses_profs');
    }
}
