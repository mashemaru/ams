<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyChapterInEditedBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_chapter_in_edited_book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('author')->nullable();
            $table->text('title_of_work')->nullable();
            $table->text('title_of_book')->nullable();
            $table->text('editor')->nullable();
            $table->text('publisher')->nullable();
            $table->text('place_of_publication')->nullable();
            $table->text('date_of_publication')->nullable();
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
        Schema::dropIfExists('faculty_chapter_in_edited_book');
    }
}
