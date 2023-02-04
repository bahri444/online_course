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

        Schema::create('question', function (Blueprint $table) {
            $table->id('id_question');
            $table->foreignId('id_modul');
            $table->string('one');
            $table->string('two');
            $table->enum('status_question', ['nonaktif', 'aktif', 'selesai'])->default('nonaktif');
            $table->timestamps();
            $table->foreign('id_modul')->references('id_modul')->on('modul')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('question');
    }
};
