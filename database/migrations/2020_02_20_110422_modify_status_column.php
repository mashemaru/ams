<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'overdue', 'in-progress', 'complete'])->after('due_date')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in-progress', 'complete'])->after('due_date')->default('pending');
        });
    }
}
