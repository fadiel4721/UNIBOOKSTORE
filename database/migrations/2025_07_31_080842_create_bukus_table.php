<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id(); // Primary key untuk Buku
            $table->string('kategori'); // Kategori buku
            $table->string('nama_buku'); // Nama buku
            $table->decimal('harga', 10, 2); // Harga buku
            $table->integer('stok'); // Stok buku
            $table->unsignedBigInteger('id_penerbit'); // Foreign key ke tabel penerbit
            $table->foreign('id_penerbit')->references('id')->on('penerbits')->onDelete('cascade'); // Relasi dengan penerbit
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
        Schema::dropIfExists('bukus');
    }
}
