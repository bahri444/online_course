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
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id('id_lembaga');
            $table->string('nama', 30);
            $table->string('logo', 20);
            $table->longText('tentang');
            $table->string('kontak', 12);
            $table->string('email', 30);
            $table->string('whatsapp', 12);
            $table->string('facebook', 30);
            $table->string('instagram', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lembaga');
    }
};
