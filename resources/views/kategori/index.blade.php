@extends('app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Kategori</h2>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($categories->isEmpty())
            <div class="alert alert-info" role="alert">
                Belum ada kategori. <a href="{{ route('kategori.create') }}">Buat kategori sekarang</a>.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->nama_kategori }}</td>
                                <td>{{ $category->deskripsi ? Str::limit($category->deskripsi, 50) : '-' }}</td>
                                <td><span class="badge bg-info">{{ $category->barangs_count }}</span></td>
                                <td>
                                    <a href="{{ route('kategori.edit', $category) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-kategori-id="{{ $category->id }}" data-kategori-name="{{ $category->nama_kategori }}">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori "<span id="kategoriName"></span>"?</p>
                <p class="text-warning"><small>Catatan: Barang yang terkait dengan kategori ini tidak akan dihapus, hanya kategorinya saja.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('deleteModal').addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    const kategoriId = button.getAttribute('data-kategori-id');
    const kategoriName = button.getAttribute('data-kategori-name');
    document.getElementById('kategoriName').textContent = kategoriName;
    document.getElementById('deleteForm').action = '/kategori/' + kategoriId;
});
</script>
@endsection
