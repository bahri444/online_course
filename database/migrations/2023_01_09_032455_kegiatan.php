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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->foreignId('id_kategori_keg');
            $table->string('nama_kegiatan', 70);
            $table->string('foto_keg', 25);
            $table->longText('deskripsi');
            $table->longText('tujuan');
            $table->longText('manfaat');
            $table->date('dari');
            $table->date('sampai');
            $table->timestamps();
            $table->foreign('id_kategori_keg')->references('id_kategori_keg')->on('kategori_kegiatan')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kegiatan');
    }
};
