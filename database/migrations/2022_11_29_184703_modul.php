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
        Schema::create('modul', function (Blueprint $table) {
            $table->id('id_modul');
            $table->foreignId('id_kategori_modul');
            $table->foreignId('id_kelas');
            $table->string('judul', 50);
            $table->longText('materi');
            $table->integer('modul_ke');
            $table->date('tgl_terbit');
            $table->string('penulis', 50);
            $table->enum('status_bel', ['nonaktif', 'aktif', 'selesai'])->default('nonaktif');
            $table->timestamps();
            $table->foreign('id_kategori_modul')->references('id_kategori_modul')->on('kategori_modul')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modul');
    }
};
