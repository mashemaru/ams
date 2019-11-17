<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEvidenceCompleteToAccreditationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accreditations', function (Blueprint $table) {
            $table->boolean('evidence_complete')->after('progress')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accreditations', function (Blueprint $table) {
            $table->dropColumn('evidence_complete');
        });
    }
}
