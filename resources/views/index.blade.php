@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Daftar Buku</h1>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('home') }}" class="mb-4 d-flex justify-content-center">
        <input type="text" name="search" class="form-control" placeholder="Cari Buku..." value="{{ $search }}"
            style="max-width: 400px;">
        <button type="submit" class="btn btn-primary ms-2">Cari</button>
    </form>

    <!-- Tabel Daftar Buku -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->nama_buku }}</td>
                        <td>{{ $buku->kategori }}</td>
                        <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ $buku->stok }}</td>
                        <td>{{ $buku->penerbit->nama }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $bukus->links('pagination::bootstrap-5') }}
    </div>
@endsection

@section('scripts')
    @if (session('message'))
        <script>
            Swal.fire({
                icon: '{{ session('message_icon') }}',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif
@endsection
