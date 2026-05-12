@extends('app')

@section('content')
<style>
    .table-bordered th, .table-bordered td { border: 1px solid #dee2e6 !important; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Manajemen <span class="text-muted fw-normal fs-5">Kategori</span></h4>
    <a href="{{ route('kategori.create') }}" class="btn btn-dark shadow-sm px-4">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small fw-bold text-uppercase">
                        <th class="py-3 ps-4">Nama kategori</th>
                        <th>Jumlah barang</th>
                        <th>Tanggal dibuat</th>
                        <th class="text-center" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $item)
                        <tr>
                            <td class="ps-4 fw-medium text-dark">{{ $item->nama_kategori }}</td>
                            <td>
                                <span class="badge bg-light text-dark border fw-normal px-3 py-1">
                                    {{ $item->barangs_count ?? 0 }} barang
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('j M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center py-1">
                                        <i class="bi bi-pencil-square me-1 small"></i>Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger d-flex align-items-center py-1" data-bs-toggle="modal" data-bs-target="#deleteKategoriModal" data-kategori-id="{{ $item->id }}" data-kategori-name="{{ $item->nama_kategori }}">
                                        <i class="bi bi-trash me-1 small"></i>Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted small">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger fw-bold">⚠️ Hapus Kategori?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                Apakah Anda yakin ingin menghapus kategori <strong id="kategoriName"></strong>? <br><br>
                <span class="text-muted small">Catatan: Barang yang ada di kategori ini tidak akan terhapus, melainkan menjadi status "Tanpa Kategori".</span>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form id="deleteKategoriForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('deleteKategoriModal').addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        const kategoriId = button.getAttribute('data-kategori-id');
        const kategoriName = button.getAttribute('data-kategori-name');
        
        document.getElementById('kategoriName').textContent = kategoriName;
        // Arahkan action form ke route destroy yang benar
        document.getElementById('deleteKategoriForm').action = '/kategori/' + kategoriId;
    });
</script>
@endsection