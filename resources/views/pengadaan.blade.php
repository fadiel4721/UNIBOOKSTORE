<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadaan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Pengadaan Buku</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
