<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari plural model
    protected $table = 'bukus';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kategori',
        'nama_buku',
        'harga',
        'stok',
        'id_penerbit',
    ];

    /**
     * Relasi ke Penerbit
     * Setiap buku hanya dimiliki oleh satu penerbit
     */
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }
}
