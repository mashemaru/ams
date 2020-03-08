<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenceListAppendixExhibitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_lists_appendix_exhibit', function (Blueprint $table) {
            $table->unsignedBigInteger('appendix_exhibit_id');
            $table->unsignedBigInteger('evidence_lists_id');

            $table->foreign('appendix_exhibit_id')->references('id')->on('appendix_exhibits')->onDelete('cascade');
            $table->foreign('evidence_lists_id')->references('id')->on('evidence_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidence_lists_appendix_exhibit');
    }
}
