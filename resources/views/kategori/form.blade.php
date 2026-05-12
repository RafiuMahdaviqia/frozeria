@extends('app')

@section('content')
<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                &laquo; Kembali
            </a>
            <h5 class="fw-bold mb-0">{{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori' }}</h5>
        </div>

        <form action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}" method="POST">
            @csrf
            @if(isset($kategori))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="nama_kategori" class="form-label text-muted small fw-bold">Nama kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" required>
                @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label text-muted small fw-bold">Deskripsi (opsional)</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Produk berbahan dasar...">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="{{ route('kategori.index') }}" class="btn btn-light border text-muted px-4">Batal</a>
                <button type="submit" class="btn btn-outline-success px-4 fw-medium">{{ isset($kategori) ? 'Update Kategori' : 'Simpan Kategori' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection