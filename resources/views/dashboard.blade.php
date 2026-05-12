@extends('app')

@section('content')
<style>
    .table-bordered th, .table-bordered td { border: 1px solid #dee2e6 !important; }
    .btn-action-gap { gap: 8px !important; }
</style>

<div class="mb-4">
    <h4 class="fw-bold mb-0">Frozeria Stok <span class="text-muted fw-normal fs-5">Dashboard</span></h4>
</div>

<div class="row mb-4 text-center">
    @php
        $cards = [
            ['Total barang', $totalBarang, 'border-dark', 'text-dark'],
            ['Total kategori', $totalKategori, 'border-dark', 'text-dark'],
            ['Stok menipis', $stokMenipis, 'border-warning', 'text-dark'],
            ['Stok habis', $stokHabis, 'border-danger', 'text-danger']
        ];
    @endphp
    @foreach($cards as $card)
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm h-100 border-0 border-bottom border-4 {{ $card[2] }}">
            <div class="card-body py-4">
                <h6 class="text-muted small text-uppercase mb-2">{{ $card[0] }}</h6>
                <h2 class="fw-bold mb-0 {{ $card[3] }}">{{ $card[1] }}</h2>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form id="searchForm" method="GET" action="{{ route('barang.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                        <input type="search" id="searchInput" name="search" class="form-control border-start-0" placeholder="Cari nama barang..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="categorySelect" name="kategori_id" class="form-select">
                        <option value="">Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div id="barangTableContainer">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small fw-bold text-uppercase">
                            <th class="py-3 ps-3">Nama barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga jual</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr>
                                <td class="ps-3 fw-medium">{{ $barang->nama_barang }}</td>
                                <td>
                                    @if ($barang->category)
                                        <span class="badge bg-light text-dark border fw-normal px-2 py-1">{{ $barang->category->nama_kategori }}</span>
                                    @else
                                        <span class="text-muted small">Tidak Berkategori</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold {{ $barang->jumlah_stok == 0 ? 'text-danger' : ($barang->jumlah_stok < 20 ? 'text-warning' : '') }}">
                                        {{ $barang->jumlah_stok }}
                                    </span>
                                </td>
                                <td>{{ $barang->satuan }}</td>
                                <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center btn-action-gap">
                                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                            <i class="bi bi-info-circle me-1"></i>Detail
                                        </a>
                                        <a href="{{ route('barang.edit', $barang) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteModal" data-barang-id="{{ $barang->id }}" data-barang-name="{{ $barang->nama_barang }}">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <p class="text-muted small mb-0">Menampilkan {{ $barangs->firstItem() ?? 0 }}-{{ $barangs->lastItem() ?? 0 }} dari {{ $barangs->total() }} barang</p>
                <div>{{ $barangs->links() }}</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger fw-bold">⚠️ Hapus Barang?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                Data <span id="barangName" class="fw-bold"></span> akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const categorySelect = document.getElementById('categorySelect');
    const tableContainer = document.getElementById('barangTableContainer');

    async function fetchData() {
        const params = new URLSearchParams({
            search: searchInput.value,
            kategori_id: categorySelect.value
        });
        window.history.replaceState(null, '', `?${params.toString()}`);
        try {
            const response = await fetch(`?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            tableContainer.innerHTML = doc.getElementById('barangTableContainer').innerHTML;
        } catch (error) {
            console.error('Error:', error);
        }
    }

    let timeout = null;
    searchInput.addEventListener('input', () => {
        clearTimeout(timeout);
        timeout = setTimeout(fetchData, 300);
    });
    categorySelect.addEventListener('change', fetchData);

    document.getElementById('deleteModal').addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        document.getElementById('barangName').textContent = button.getAttribute('data-barang-name');
        document.getElementById('deleteForm').action = '/barang/' + button.getAttribute('data-barang-id');
    });
</script>
@endsection