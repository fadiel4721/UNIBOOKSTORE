<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // GET /api/books
    public function index()
    {
        $books = Buku::with('penerbit')->get();
        return response()->json($books);
    }

    // POST /api/books/{id}/buy
    public function buy($id)
    {
        $book = Buku::findOrFail($id);
        if ($book->stok <= 0) {
            return response()->json(['message' => 'Stok habis'], 400);
        }
        $book->stok--;
        $book->save();
        return response()->json([
            'book' => $book,
            'message' => 'Berhasil membeli "' . $book->nama_buku . '"',
        ]);
    }

    // POST /api/books/{id}/favorite
    public function favorite($id)
    {
        $book = Buku::findOrFail($id);
        $book->favorit = ! $book->favorit;
        $book->save();
        return response()->json([
            'book' => $book,
            'message' => $book->favorit
                ? 'Ditambahkan ke favorit'
                : 'Dihapus dari favorit',
        ]);
    }

    public function favorites()
    {
        $books = Buku::with('penerbit')
            ->where('favorit', true)
            ->get();

        return response()->json($books);
    }
}
