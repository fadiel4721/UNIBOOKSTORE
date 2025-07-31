<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penerbit;

class PenerbitSeeder extends Seeder
{
    public function run()
    {
        Penerbit::create([
            'nama' => 'Penerbit Informatika',
            'alamat' => 'Jl. Buah Batu No. 121',
            'kota' => 'Bandung',
            'telepon' => '0813-2200-1946',
        ]);

        Penerbit::create([
            'nama' => 'Andi Offset',
            'alamat' => 'Jl. Suryalaya No 03',
            'kota' => 'Bandung',
            'telepon' => '0878-3939-0588',
        ]);

        Penerbit::create([
            'nama' => 'Danendra',
            'alamat' => 'Jl. Moch. Toha 44',
            'kota' => 'Bandung',
            'telepon' => '022-5201215',
        ]);
    }
}
