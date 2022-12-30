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
        Schema::create('member', function (Blueprint $table) {
            $table->id('id_member');
            $table->foreignId('id_user');
            $table->string('nama_member', 30);
            $table->date('tgl_lhr');
            $table->string('foto', 20);
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->string('alamat', 70);
            $table->string('github', 30);
            $table->string('telepon', 14);
            $table->enum('status_member', ['nonaktif', 'aktif'])->default('nonaktif');
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('user')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member');
    }
};
