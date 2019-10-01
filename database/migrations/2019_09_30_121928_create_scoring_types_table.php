<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoringTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoring_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('scoring_name');
            $table->text('scoring_description')->nullable();
            $table->mediumText('scores')->nullable();
            $table->timestamps();
        });

        Schema::create('program_scoring', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('scoring_id');
            $table->unsignedBigInteger('program_id');

            $table->foreign('scoring_id')->references('id')->on('scoring_types')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoring_types');
        Schema::dropIfExists('program_scoring');
    }
}
