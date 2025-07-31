<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman admin dengan daftar buku dan penerbit
     */
    public function index()
    {
        $bukus = Buku::all();
        $penerbits = Penerbit::all();

        return view('admin', compact('bukus', 'penerbits'));
    }

    /**
     * Menyimpan data buku baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_buku' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'id_penerbit' => 'required|exists:penerbits,id',
        ]);

        // Simpan buku ke database
        Buku::create($request->all());

        return redirect()->route('admin.index');
    }

    /**
     * Mengupdate data buku yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_buku' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'id_penerbit' => 'required|exists:penerbits,id',
        ]);

        // Update data buku
        $buku->update($request->all());

        return redirect()->route('admin.index');
    }

    /**
     * Menghapus buku
     */
    public function destroy($id)
    {
        Buku::destroy($id);

        return redirect()->route('admin.index');
    }
}
