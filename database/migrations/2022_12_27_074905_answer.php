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
            $table->string('nama_anda', 30);
            $table->longText('a_one');
            $table->longText('a_two');
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
