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
            $table->decimal('status', 8, 2)->default('0');
            $table->text('result')->nullable();
            $table->text('progress')->nullable();
            $table->text('completed_document')->nullable();
            $table->mediumText('recommendations')->nullable();
            $table->mediumText('evidence_list')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('report_submission_date')->nullable();
            $table->dateTime('onsite_visit_date')->nullable();
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
        Schema::dropIfExists('accreditations');
    }
}
