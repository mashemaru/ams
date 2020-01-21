<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->timestamps();
        });

        Schema::create('evidence_lists_file', function (Blueprint $table) {
            $table->unsignedBigInteger('evidence_list_id');
            $table->unsignedBigInteger('file_repository_id');

            $table->foreign('evidence_list_id')->references('id')->on('evidence_lists')->onDelete('cascade');
            $table->foreign('file_repository_id')->references('id')->on('file_repositories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidence_lists');
        Schema::dropIfExists('evidence_lists_file');
    }
}
