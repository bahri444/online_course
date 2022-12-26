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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->foreignId('id_bidang');
            $table->enum('jenis_kelas', ['free', 'premium', 'bootcamp']);
            $table->double('harga_kelas');
            $table->integer('lama_course');
            $table->date('tanggal_berakhir');
            $table->timestamps();
            $table->foreign('id_bidang')->references('id_bidang')->on('bidang')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kelas');
    }
};
