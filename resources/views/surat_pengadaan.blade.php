<!DOCTYPE html>
<html>
<head>
    <title>Surat Pengadaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Surat Pengadaan Buku</h1>
    <p>Tanggal: {{ now()->format('d-m-Y') }}</p>

    <table>
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
            @foreach ($bukus as $buku)
                <tr>
                    <td>{{ $buku->nama_buku }}</td>
                    <td>{{ $buku->kategori }}</td>
                    <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td>{{ $buku->stok }}</td>
                    <td>{{ $buku->penerbit->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
