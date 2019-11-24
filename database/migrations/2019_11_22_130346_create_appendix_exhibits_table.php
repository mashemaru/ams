<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppendixExhibitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appendix_exhibits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('code');
            $table->boolean('evidence_complete')->default(false);
            $table->timestamps();
        });

        Schema::create('appendix_exhibits_evidence', function (Blueprint $table) {
            $table->unsignedBigInteger('appendix_exhibit_id');
            $table->unsignedBigInteger('evidence_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appendix_exhibits');
    }
}
