<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyConferenceProceedingsPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_conference_proceedings_papers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('paper_authors')->nullable();
            $table->text('paper_title')->nullable();
            $table->text('conference_proceedings')->nullable();
            $table->text('paper_publisher')->nullable();
            $table->text('publication_place')->nullable();
            $table->text('pages')->nullable();
            $table->text('isbn')->nullable();
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
        Schema::dropIfExists('faculty_conference_proceedings_papers');
    }
}
