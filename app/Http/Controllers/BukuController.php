<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku dengan pencarian & pagination,
     * dan flash SweetAlert hanya bila input search tidak kosong.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query dasar dengan relasi penerbit
        $query = Buku::with('penerbit');

        // Hanya filter ketika ada input non-kosong
        if ($request->filled('search')) {
            $query->where('nama_buku', 'like', '%' . $search . '%');
        }

        // Paginate 10 per halaman & append param search
        $bukus = $query
            ->orderBy('nama_buku')
            ->paginate(10)
            ->appends(['search' => $search]);

        // Hanya flash SweetAlert jika search non-kosong
        if ($request->filled('search')) {
            if ($bukus->total() > 0) {
                session()->flash('message', "Ditemukan {$bukus->total()} buku untuk “{$search}”");
                session()->flash('message_icon', 'success');
            } else {
                session()->flash('message', "Tidak ada buku ditemukan untuk “{$search}”");
                session()->flash('message_icon', 'error');
            }
        }

        return view('index', compact('bukus', 'search'));
    }
}
