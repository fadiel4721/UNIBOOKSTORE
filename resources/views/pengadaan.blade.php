@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Pengadaan Buku</h1>

    {{-- Filter threshold on the fly --}}
    <form method="GET" action="{{ route('pengadaan.index') }}" class="mb-4 d-flex align-items-center">
        <label class="me-2">Threshold stok:</label>
        <input type="number" name="threshold" class="form-control me-2" style="width: 80px" value="{{ $threshold }}">
        <button class="btn btn-primary">Terapkan</button>
    </form>

    <form method="POST" action="{{ route('pengadaan.generatePo') }}">
        @csrf

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
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
                            <td>
                                <input type="checkbox" name="book_ids[]" value="{{ $buku->id }}">
                            </td>
                            <td>{{ $buku->nama_buku }}</td>
                            <td>{{ $buku->kategori }}</td>
                            <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                            <td>{{ $buku->stok }}</td>
                            <td>{{ $buku->penerbit->nama }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Tidak ada buku dengan stok ≤ {{ $threshold }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($bukus->hasPages())
            <div class="d-flex justify-content-center mb-3">
                {{ $bukus->links('pagination::bootstrap-5') }}
            </div>
        @endif

        @if ($bukus->count())
            <button type="submit" class="btn btn-success">
                Buat Surat Pengadaan ({{ $bukus->count() }} Buku)
            </button>
        @endif
    </form>

    @if (session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif
@endsection

@section('scripts')
    <script>
        // Check/uncheck all
        document.getElementById('checkAll')?.addEventListener('change', function() {
            document.querySelectorAll('input[name="book_ids[]"]').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    </script>
@endsection
