<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbits', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama penerbit
            $table->string('alamat'); // Alamat penerbit
            $table->string('kota'); // Kota penerbit
            $table->string('telepon'); // Telepon penerbit
            $table->timestamps(); // Waktu dibuat dan diupdate
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerbits');
    }
}
