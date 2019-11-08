<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('course_name');
            $table->text('course_code');
            $table->text('syllabus')->nullable();
            $table->boolean('is_academic')->default(true);
            $table->decimal('units', 8, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('course_requisites', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('requisite_id');
            $table->enum('requisite', ['hard', 'soft', 'co']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('requisite_id')->references('id')->on('courses')->onDelete('cascade');
        });

        Schema::create('course_faculty', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('courses_requisites');
        Schema::dropIfExists('course_faculty');
    }
}
