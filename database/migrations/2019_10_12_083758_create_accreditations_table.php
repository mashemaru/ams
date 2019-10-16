<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccreditationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accreditations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('document_id');
            $table->enum('type', ['initial', 'reaccredit']);
            $table->text('result')->nullable();
            $table->text('completed_document')->nullable();
            $table->mediumText('recommendations')->nullable();
            $table->dateTime('report_submission_date');
            $table->dateTime('onsite_visit_date');
            $table->timestamps();

            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accreditations');
    }
}
