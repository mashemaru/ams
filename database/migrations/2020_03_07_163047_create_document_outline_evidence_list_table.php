<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentOutlineEvidenceListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_outline_evidence_list', function (Blueprint $table) {
            $table->unsignedBigInteger('document_outline_id');
            $table->unsignedBigInteger('evidence_lists_id');

            $table->foreign('document_outline_id')->references('id')->on('document_outline')->onDelete('cascade');
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
        Schema::dropIfExists('document_outline_evidence_list');
    }
}
