@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Admin - Kelola Buku</h1>

    <!-- Button untuk Menambah Buku -->
    <button class="btn btn-success btn-custom mb-4" data-bs-toggle="modal" data-bs-target="#addBookModal">
        Tambah Buku
    </button>

    <!-- Tabel Buku -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Cover</th>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $buku)
                    <tr>
                        <td>
                            @if ($buku->foto)
                                <img src="{{ asset('storage/' . $buku->foto) }}" width="60">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $buku->nama_buku }}</td>
                        <td>{{ $buku->kategori }}</td>
                        <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ $buku->stok }}</td>
                        <td>{{ $buku->penerbit->nama }}</td>
                        <td>
                            <button class="btn btn-warning btn-custom editBookBtn" data-bs-toggle="modal"
                                data-bs-target="#editBookModal" data-id="{{ $buku->id }}"
                                data-nama_buku="{{ $buku->nama_buku }}" data-kategori="{{ $buku->kategori }}"
                                data-harga="{{ $buku->harga }}" data-stok="{{ $buku->stok }}"
                                data-penerbit="{{ $buku->id_penerbit }}"
                                data-foto="{{ asset('storage/' . $buku->foto) }}">
                                Edit
                            </button>

                            <form method="POST" action="{{ route('admin.destroy', $buku->id) }}" class="d-inline"
                                id="delete-form-{{ $buku->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-custom"
                                    onclick="confirmDelete({{ $buku->id }})">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $bukus->links('pagination::bootstrap-5') }}
    </div>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Buku</label>
                            <input type="text" name="nama_buku" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <select name="id_penerbit" class="form-control" required>
                                @foreach ($penerbits as $penerbit)
                                    <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Cover Buku</label>
                            <input type="file" name="foto" class="form-control" id="addCoverPreview">
                            <img src="" id="addCoverImage" class="mt-3" style="max-width: 150px; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Buku -->
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="editForm" action="#" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Buku</label>
                            <input type="text" name="nama_buku" id="edit_nama_buku" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" id="edit_kategori" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" id="edit_harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" id="edit_stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <select name="id_penerbit" id="edit_id_penerbit" class="form-control" required>
                                @foreach ($penerbits as $penerbit)
                                    <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Cover Buku (Opsional)</label>
                            <input type="file" name="foto" id="editCoverPreview" class="form-control">
                            <img src="" id="editCoverImage" class="mt-3"
                                style="max-width: 150px; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    <script>
        // Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus buku ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Preview gambar pada form tambah buku
        document.getElementById('addCoverPreview').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const image = document.getElementById('addCoverImage');
                    image.src = e.target.result;
                    image.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Preview gambar pada form edit buku
        document.getElementById('editCoverPreview').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const image = document.getElementById('editCoverImage');
                    image.src = e.target.result;
                    image.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Isi form edit saat tombol edit diklik
        document.querySelectorAll('.editBookBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama_buku = this.dataset.nama_buku;
                const kategori = this.dataset.kategori;
                const harga = this.dataset.harga;
                const stok = this.dataset.stok;
                const penerbit = this.dataset.penerbit;
                const foto = this.dataset.foto;

                // Update action URL dengan ID buku yang sesuai
                const actionUrl = `/admin/update/${id}`;
                document.getElementById('editForm').setAttribute('action', actionUrl);
                document.getElementById('edit_nama_buku').value = nama_buku;
                document.getElementById('edit_kategori').value = kategori;
                document.getElementById('edit_harga').value = harga;
                document.getElementById('edit_stok').value = stok;
                document.getElementById('edit_id_penerbit').value = penerbit;

                // Preview gambar pada form edit
                const editImage = document.getElementById('editCoverImage');
                editImage.src = foto;
                editImage.style.display = 'block';
            });
        });
    </script>
@endsection
