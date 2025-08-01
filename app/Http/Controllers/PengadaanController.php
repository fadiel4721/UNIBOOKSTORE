<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;


class PengadaanController extends Controller
{
    /**
     * Menampilkan buku dengan stok kritis (<= threshold)
     */
    public function index(Request $request)
    {
        $defaultThreshold = config('app.procurement_threshold', 10);
        $threshold = $request->query('threshold', $defaultThreshold);

        // Ambil buku dengan stok ≤ threshold, urutkan ascending, paginate 10
        $bukus = Buku::with('penerbit')
            ->where('stok', '<=', $threshold)
            ->orderBy('stok', 'asc')
            ->paginate(10)
            ->appends(['threshold' => $threshold]);

        return view('pengadaan', compact('bukus', 'threshold'));
    }

    /**
     * (Opsional) Generate Purchase Order
     */
    // public function generatePo(Request $request)
    // {
    //     $bookIds = $request->input('book_ids', []);
    //     // Logika pembuatan PO: bisa insert ke tabel `pengadaan`, kirim email, export PDF, dll.
    //     // ...
    //     session()->flash('message', 'Surat pengadaan berhasil dibuat untuk ' . count($bookIds) . ' buku');
    //     return redirect()->route('pengadaan.index');
    // }

    public function generatePo(Request $request)
    {
        $bookIds = $request->input('book_ids', []);

        // Ambil buku berdasarkan ID yang dipilih
        $bukus = Buku::whereIn('id', $bookIds)->get();

        // Buat PDF
        $pdf = FacadePdf::loadView('surat_pengadaan', compact('bukus'));

        // Simpan atau langsung download PDF
        return $pdf->download('surat_pengadaan.pdf');
    }
}
