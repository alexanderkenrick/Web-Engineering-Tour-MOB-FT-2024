<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->foreignId('users_id');
            $table->foreign('users_id')->references('id')->on('users');

            $table->foreignId('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('pos_id');
            $table->foreign('pos_id')->references('pos_id')->on('questions')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('options_id');
            $table->foreign('options_id')->references('id')->on('options')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
