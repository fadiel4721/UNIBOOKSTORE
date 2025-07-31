<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Toko Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Admin - Kelola Buku</h1>

        <form method="POST" action="{{ route('admin.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nama_buku" class="form-label">Nama Buku</label>
                <input type="text" name="nama_buku" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="id_penerbit" class="form-label">Penerbit</label>
                <select name="id_penerbit" class="form-control" required>
                    @foreach($penerbits as $penerbit)
                    <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Buku</button>
        </form>

        <h2 class="mt-4">Daftar Buku</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bukus as $buku)
                <tr>
                    <td>{{ $buku->nama_buku }}</td>
                    <td>{{ $buku->kategori }}</td>
                    <td>{{ $buku->harga }}</td>
                    <td>{{ $buku->stok }}</td>
                    <td>{{ $buku->penerbit->nama }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.update', $buku->id) }}">
                            @csrf
                            <input type="text" name="nama_buku" value="{{ $buku->nama_buku }}">
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </form>
                        <form method="POST" action="{{ route('admin.destroy', $buku->id) }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
