@extends('app')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <h2 class="mb-4">
            @if (isset($barang))
                Edit Barang
            @else
                Tambah Barang
            @endif
        </h2>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ isset($barang) ? route('barang.update', $barang) : route('barang.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($barang))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('kategori_id', $barang->kategori_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="foto_barang" class="form-label">Foto Barang</label>
                                <input type="file" class="form-control @error('foto_barang') is-invalid @enderror" id="foto_barang" name="foto_barang" accept="image/*">
                                @error('foto_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (isset($barang) && $barang->foto_barang)
                                    <div class="mt-2">
                                        <small class="text-muted">Foto saat ini:</small><br>
                                        <img src="{{ Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}" style="max-width: 150px; margin-top: 5px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan', $barang->satuan ?? '') }}" placeholder="contoh: Pcs, Kg, Liter" required>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="jumlah_stok" class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('jumlah_stok') is-invalid @enderror" id="jumlah_stok" name="jumlah_stok" value="{{ old('jumlah_stok', $barang->jumlah_stok ?? '') }}" required>
                                @error('jumlah_stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="stok_minimum" class="form-label">Stok Minimum <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stok_minimum') is-invalid @enderror" id="stok_minimum" name="stok_minimum" value="{{ old('stok_minimum', $barang->stok_minimum ?? '') }}" required>
                                @error('stok_minimum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $barang->harga_beli ?? '') }}" required>
                                @error('harga_beli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="harga_jual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual ?? '') }}" required>
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="berat_ukuran" class="form-label">Berat/Ukuran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('berat_ukuran') is-invalid @enderror" id="berat_ukuran" name="berat_ukuran" value="{{ old('berat_ukuran', $barang->berat_ukuran ?? '') }}" placeholder="contoh: 500g, 1kg, 10x10cm" required>
                                @error('berat_ukuran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lokasi_simpan" class="form-label">Lokasi Simpan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi_simpan') is-invalid @enderror" id="lokasi_simpan" name="lokasi_simpan" value="{{ old('lokasi_simpan', $barang->lokasi_simpan ?? '') }}" placeholder="contoh: Rak A1, Freezer 2" required>
                                @error('lokasi_simpan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $barang->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            @if (isset($barang))
                                Perbarui
                            @else
                                Simpan
                            @endif
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
