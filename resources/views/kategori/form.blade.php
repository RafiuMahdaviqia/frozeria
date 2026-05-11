@extends('app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="mb-4">
            @if (isset($category))
                Edit Kategori
            @else
                Tambah Kategori
            @endif
        </h2>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ isset($category) ? route('kategori.update', $category) : route('kategori.store') }}">
                    @csrf
                    @if (isset($category))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $category->nama_kategori ?? '') }}" required>
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $category->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            @if (isset($category))
                                Perbarui
                            @else
                                Simpan
                            @endif
                        </button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
