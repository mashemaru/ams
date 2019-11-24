<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyPrototypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_prototypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('author')->nullable();
            $table->text('title')->nullable();
            $table->text('journal_name')->nullable();
            $table->text('date')->nullable();
            $table->text('volume_number')->nullable();
            $table->text('issue_number')->nullable();
            $table->text('pages')->nullable();
            $table->text('issn_isbn')->nullable();
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
        Schema::dropIfExists('faculty_prototypes');
    }
}
