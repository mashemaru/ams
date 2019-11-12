<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agency_id');
            $table->text('document_name');
            $table->longText('sections');
            $table->timestamps();
        });

        Schema::create('document_outline', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('root_parent_id')->default(0);
            $table->text('section')->nullable();
            $table->longText('body')->nullable();
            $table->text('score')->nullable();
            $table->text('reference')->nullable();
            $table->enum('doc_type', ['Narrative', 'Narrative w/ Table', 'Narrative w/ Score', 'Narrative w/ Table & Score'])->default('Narrative');
            $table->unsignedBigInteger('score_type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('document_outline');
    }
}
