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
            $table->enum('type', ['appendix', 'exhibit']);
            $table->boolean('evidence_complete')->default(false);
            $table->timestamps();
        });

        Schema::create('appendix_exhibits_evidence', function (Blueprint $table) {
            $table->unsignedBigInteger('appendix_exhibit_id');
            $table->unsignedBigInteger('evidence_id');
        });

        Schema::create('document_outline_appendix_exhibits', function (Blueprint $table) {
            $table->unsignedBigInteger('document_outline_id');
            $table->unsignedBigInteger('appendix_exhibits_id');
            $table->unsignedBigInteger('accreditation_id');
        });

        Schema::create('recommendations_appendix_exhibits', function (Blueprint $table) {
            $table->unsignedBigInteger('accreditation_id');
            $table->unsignedBigInteger('appendix_exhibits_id');
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
        Schema::dropIfExists('appendix_exhibits_evidence');
        Schema::dropIfExists('document_outline_appendix_exhibits');
        Schema::dropIfExists('recommendations_appendix_exhibits');
    }
}
