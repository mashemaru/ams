<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyAcademicBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_academic_background', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('degrees_earned')->nullable();
            $table->text('title_of_degree')->nullable();
            $table->text('area_of_specialization')->nullable();
            $table->text('year_obtained')->nullable();
            $table->text('educational_institution')->nullable();
            $table->text('location')->nullable();
            $table->text('so_number')->nullable();
            $table->timestamps();
            
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
        Schema::dropIfExists('faculty_academic_background');
    }
}
