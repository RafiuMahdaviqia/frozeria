@extends('app')

@section('content')
<style>
    /* Styling khusus agar kotak detail persis seperti Mockup Soal */
    .detail-box {
        border: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
        background-color: #fff;
        height: 100%;
    }
    .detail-label {
        font-size: 0.85rem;
        color: #858c93;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 0;
    }
</style>

<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom pb-3 mb-4 gap-3">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-secondary px-3">
                    &laquo; Kembali
                </a>
                <h5 class="fw-bold mb-0">Detail Barang</h5>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-outline-primary px-4">Edit Barang</a>
                <button type="button" class="btn btn-sm btn-outline-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
            </div>
        </div>

        <div class="d-flex align-items-center mb-4">
            <div class="me-4">
                @if($barang->foto_barang)
                    <img src="{{ asset('storage/' . $barang->foto_barang) }}" alt="{{ $barang->nama_barang }}" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    <div class="img-thumbnail d-flex justify-content-center align-items-center bg-light" style="width: 120px; height: 120px;">
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                    </div>
                @endif
            </div>
            <div>
                <h4 class="fw-bold mb-2">{{ $barang->nama_barang }}</h4>
                <span class="badge border border-secondary text-dark fw-normal px-3 py-1">
                    {{ $barang->category ? $barang->category->nama_kategori : 'Tanpa Kategori' }}
                </span>
            </div>
        </div>

        <div class="row g-0 border-top border-start border-end">
            
            <div class="col-md-6 border-bottom border-end">
                <div class="detail-box">
                    <p class="detail-label">Jumlah stok</p>
                    <p class="detail-value">{{ $barang->jumlah_stok }} {{ $barang->satuan }}</p>
                </div>
            </div>
            <div class="col-md-6 border-bottom">
                <div class="detail-box">
                    <p class="detail-label">Stok minimum</p>
                    <p class="detail-value">{{ $barang->stok_minimum }} {{ $barang->satuan }}</p>
                </div>
            </div>

            <div class="col-md-6 border-bottom border-end">
                <div class="detail-box">
                    <p class="detail-label">Harga jual</p>
                    <p class="detail-value">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="col-md-6 border-bottom">
                <div class="detail-box">
                    <p class="detail-label">Harga beli</p>
                    <p class="detail-value">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="col-md-6 border-bottom border-end">
                <div class="detail-box">
                    <p class="detail-label">Berat / ukuran</p>
                    <p class="detail-value">{{ $barang->berat_ukuran }}</p>
                </div>
            </div>
            <div class="col-md-6 border-bottom">
                <div class="detail-box">
                    <p class="detail-label">Lokasi simpan</p>
                    <p class="detail-value">{{ $barang->lokasi_simpan }}</p>
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="detail-box">
                    <p class="detail-label">Deskripsi</p>
                    <p class="mb-0 text-dark" style="font-size: 0.95rem;">
                        {{ $barang->deskripsi ? $barang->deskripsi : 'Tidak ada deskripsi untuk barang ini.' }}
                    </p>
                </div>
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
                Apakah Anda yakin ingin menghapus <strong>{{ $barang->nama_barang }}</strong>? Data akan hilang permanen dari sistem.
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection