<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentOutlineUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_outline_users', function (Blueprint $table) {
            $table->unsignedBigInteger('document_outline_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('body')->nullable();
            $table->text('score')->nullable();
            $table->boolean('selected')->default(false);
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
        Schema::dropIfExists('document_outline_users');
    }
}
