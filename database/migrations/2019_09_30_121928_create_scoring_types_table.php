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
            $table->text('scoring_description');
            $table->mediumText('scores')->nullable();
            $table->timestamps();
        });

        Schema::create('program_scoring', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('scoring_id');
            $table->unsignedInteger('program_id');
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
