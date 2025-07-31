<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class PengadaanController extends Controller
{
    /**
     * Menampilkan daftar buku yang stoknya sedikit (<= 20)
     */
    public function index()
    {
        // Ambil semua buku dengan stok sedikit
        $bukus = Buku::where('stok', '<=', 20)->get();

        return view('pengadaan', compact('bukus'));
    }
}
