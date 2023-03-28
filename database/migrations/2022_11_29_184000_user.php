<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\NullType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->foreignId('id_bidang')->nullable();
            $table->string('nama_lengkap', 30);
            $table->string('email', 45)->unique();
            $table->string('password', 100);
            $table->enum('role', ['admin', 'mentor', 'member'])->default('member');
            $table->date('tgl_lhr')->nullable();
            $table->string('foto', 20)->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->string('alamat', 70)->nullable();
            $table->string('github', 30)->nullable();
            $table->string('telepon', 14)->nullable();
            $table->enum('status_akun', ['nonaktif', 'aktif'])->default('nonaktif')->nullable();
            $table->timestamps();
            $table->foreign('id_bidang')->references('id_bidang')->on('bidang')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->string('token', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
};
