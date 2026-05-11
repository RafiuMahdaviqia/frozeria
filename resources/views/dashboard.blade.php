@extends('app')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title text-white-50">Total Barang</h6>
                <h3>{{ $totalBarang }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6 class="card-title text-white-50">Stok Menipis</h6>
                <h3>{{ $stokMenipis }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6 class="card-title text-white-50">Stok Habis</h6>
                <h3>{{ $stokHabis }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Barang</h5>
        <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Barang
        </a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('barang.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                        <tr>
                            <td>{{ ($barangs->currentPage() - 1) * $barangs->perPage() + $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>
                                @if ($barang->category)
                                    {{ $barang->category->nama_kategori }}
                                @else
                                    <span class="badge bg-secondary">Tidak Berkategori</span>
                                @endif
                            </td>
                            <td>
                                @if ($barang->jumlah_stok == 0)
                                    <span class="badge bg-danger">Habis</span>
                                @elseif ($barang->jumlah_stok < 20)
                                    <span class="badge bg-warning">{{ $barang->jumlah_stok }}</span>
                                @else
                                    {{ $barang->jumlah_stok }}
                                @endif
                            </td>
                            <td>{{ $barang->satuan }}</td>
                            <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $barang) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-barang-id="{{ $barang->id }}" data-barang-name="{{ $barang->nama_barang }}">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $barangs->links() }}
        </div>
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
                <p>Apakah Anda yakin ingin menghapus barang "<span id="barangName"></span>"?</p>
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
    const barangId = button.getAttribute('data-barang-id');
    const barangName = button.getAttribute('data-barang-name');
    document.getElementById('barangName').textContent = barangName;
    document.getElementById('deleteForm').action = '/barang/' + barangId;
});
</script>
@endsection