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
    public function index(Request $request)
    {
        // Ambil daftar penerbit untuk dropdown
        $penerbits = Penerbit::all();

        // Ambil buku dengan relasi penerbit, paginate 10 per halaman
        $bukus = Buku::with('penerbit')
            ->orderBy('nama_buku')
            ->paginate(10);

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Jika ada file gambar yang diupload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('covers', 'public');
        }

        // Simpan ke database
        Buku::create($data);

        session()->flash('message', 'Buku berhasil ditambahkan');
        return redirect()->route('admin.index');
    }

    /**
     * Mengupdate data buku yang sudah ada
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_buku' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'id_penerbit' => 'required|exists:penerbits,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $buku = Buku::findOrFail($id);
        $data = $request->all();

        // Jika ada file baru diupload, simpan dan timpa
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('covers', 'public');
        }

        $buku->update($data);

        session()->flash('message', 'Buku berhasil diupdate');
        return redirect()->route('admin.index');
    }

    /**
     * Menghapus buku
     */
    public function destroy($id)
    {
        Buku::destroy($id);

        session()->flash('message', 'Buku berhasil dihapus');
        return redirect()->route('admin.index');
    }
}
