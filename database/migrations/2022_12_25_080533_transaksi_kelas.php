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
        Schema::create('transaksi_kelas', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_member');
            $table->foreignId('id_kelas');
            $table->date('tgl_bayar');
            $table->enum('validasi_pembayaran', ['pending', 'valid'])->default('pending');
            $table->timestamps();
            $table->foreign('id_member')->references('id_member')->on('member')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::drop('transaksi_kelas');
    }
};
