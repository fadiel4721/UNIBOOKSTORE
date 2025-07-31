<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run()
    {
        Buku::create([
            'kategori' => 'Keilmuan',
            'nama_buku' => 'Analisis & Perancangan Sistem Informasi',
            'harga' => 50000,
            'stok' => 60,
            'id_penerbit' => 1,
        ]);

        Buku::create([
            'kategori' => 'Keilmuan',
            'nama_buku' => 'Artificial Intelligence',
            'harga' => 45000,
            'stok' => 60,
            'id_penerbit' => 1,
        ]);

        Buku::create([
            'kategori' => 'Keilmuan',
            'nama_buku' => 'Autocad 3 Dimensi',
            'harga' => 75000,
            'stok' => 60,
            'id_penerbit' => 1,
        ]);

        Buku::create([
            'kategori' => 'Keilmuan',
            'nama_buku' => 'Cloud Computing Technology',
            'harga' => 87500,
            'stok' => 12,
            'id_penerbit' => 1,
        ]);

        Buku::create([
            'kategori' => 'Bisnis',
            'nama_buku' => 'Etika Bisnis dan Tanggung Jawab Sosial',
            'harga' => 67500,
            'stok' => 50,
            'id_penerbit' => 2,
        ]);

        Buku::create([
            'kategori' => 'Novel',
            'nama_buku' => 'Aku Ingin Cinta',
            'harga' => 48000,
            'stok' => 100,
            'id_penerbit' => 3,
        ]);
    }
}
