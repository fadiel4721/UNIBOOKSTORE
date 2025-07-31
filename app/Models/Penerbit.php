<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari plural model
    protected $table = 'penerbits';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'telepon',
    ];

    /**
     * Relasi ke Buku
     * Satu penerbit bisa memiliki banyak buku
     */
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'id_penerbit');
    }
}
