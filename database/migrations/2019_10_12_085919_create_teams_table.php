<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('team_name');
            $table->unsignedBigInteger('team_head');
            $table->timestamps();

            $table->foreign('team_head')->references('id')->on('users');
        });

        Schema::create('accreditation_team', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accreditation_id');
            $table->unsignedBigInteger('team_id');

            $table->foreign('accreditation_id')->references('id')->on('accreditations')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::create('user_team', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('teams');
        Schema::dropIfExists('accreditation_team');
        Schema::dropIfExists('user_team');
    }
}
