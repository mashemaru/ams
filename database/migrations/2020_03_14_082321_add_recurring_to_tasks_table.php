<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecurringToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('recurring')->default(false)->after('status');
            $table->text('recurring_freq')->nullable()->after('recurring');
            $table->date('recurring_date')->nullable()->after('recurring_freq');
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
            $table->dropColumn('recurring');
            $table->dropColumn('recurring_freq');
            $table->dropColumn('recurring_date');
        });
    }
}
