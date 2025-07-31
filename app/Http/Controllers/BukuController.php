<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku dengan fitur pencarian
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari input user
        $search = $request->input('search');

        // Jika ada pencarian, filter berdasarkan nama buku
        if ($search) {
            $bukus = Buku::where('nama_buku', 'like', '%' . $search . '%')->get();
        } else {
            // Ambil semua data buku jika tidak ada pencarian
            $bukus = Buku::all();
        }

        return view('index', compact('bukus'));
    }
}
