<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->id('id_answer');
            $table->foreignId('id_question');
            $table->string('a_one');
            $table->string('a_two');
            $table->string('a_three');
            $table->string('a_four');
            $table->string('a_five');
            $table->string('a_six');
            $table->string('a_seven');
            $table->string('a_eight');
            $table->string('a_nine');
            $table->string('a_ten');
            $table->enum('status_answer', ['nonaktif', 'aktif', 'selesai'])->default('nonaktif');
            $table->timestamps();
            $table->foreign('id_question')->references('id_question')->on('question')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer');
    }
};
