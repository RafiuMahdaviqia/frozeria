@extends('app')

@section('content')
<style>
    .upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
        padding: 3rem 1rem;
        text-align: center;
        transition: all 0.3s;
    }
    .upload-area:hover {
        border-color: #6c757d;
        background-color: #e9ecef;
    }
</style>

<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                &laquo; Kembali
            </a>
            <h5 class="fw-bold mb-0">{{ isset($barang) ? 'Edit Barang' : 'Tambah Barang Baru' }}</h5>
        </div>

        <form action="{{ isset($barang) ? route('barang.update', $barang->id) : route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($barang))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="foto_barang" class="form-label text-muted small fw-bold">Foto barang</label>
                <div class="upload-area position-relative">
                    @if(isset($barang) && $barang->foto_barang)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $barang->foto_barang) }}" alt="Foto Lama" class="img-thumbnail" style="max-height: 150px;">
                            <p class="text-muted small mt-2">Foto saat ini</p>
                        </div>
                    @else
                        <i class="bi bi-image text-muted" style="font-size: 2.5rem;"></i>
                        <p class="text-muted mt-2 mb-1">Klik untuk memilih foto, atau seret file ke sini</p>
                        <p class="text-muted small mb-3">Format: JPG, PNG — Maks. 2 MB</p>
                    @endif
                    <input type="file" name="foto_barang" id="foto_barang" class="form-control" accept=".jpg,.jpeg,.png">
                </div>
                @error('foto_barang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="nama_barang" class="form-label text-muted small fw-bold">Nama barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
                @error('nama_barang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="kategori_id" class="form-label text-muted small fw-bold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori_id" id="kategori_id" class="form-select" required>
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (old('kategori_id', $barang->kategori_id ?? '')) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="satuan" class="form-label text-muted small fw-bold">Satuan <span class="text-danger">*</span></label>
                    <select name="satuan" id="satuan" class="form-select" required>
                        <option value="">Pilih satuan</option>
                        @php $opsiSatuan = ['Pcs', 'Pack', 'Box', 'Gram', 'Kg', 'Karton']; @endphp
                        @foreach ($opsiSatuan as $opt)
                            <option value="{{ $opt }}" {{ (old('satuan', $barang->satuan ?? '')) == $opt ? 'selected' : '' }}>
                                {{ $opt }}
                            </option>
                        @endforeach
                    </select>
                    @error('satuan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jumlah_stok" class="form-label text-muted small fw-bold">Jumlah stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="jumlah_stok" id="jumlah_stok" min="0" value="{{ old('jumlah_stok', $barang->jumlah_stok ?? '') }}" required>
                    @error('jumlah_stok') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="stok_minimum" class="form-label text-muted small fw-bold">Stok minimum <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="stok_minimum" id="stok_minimum" min="0" value="{{ old('stok_minimum', $barang->stok_minimum ?? '') }}" required>
                    @error('stok_minimum') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="harga_jual" class="form-label text-muted small fw-bold">Harga jual (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="harga_jual" id="harga_jual" min="0" max="1000000000" value="{{ old('harga_jual', $barang->harga_jual ?? '') }}" required>
                    @error('harga_jual') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="harga_beli" class="form-label text-muted small fw-bold">Harga beli (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="harga_beli" id="harga_beli" min="0" max="1000000000" value="{{ old('harga_beli', $barang->harga_beli ?? '') }}" required>
                    @error('harga_beli') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="berat_ukuran" class="form-label text-muted small fw-bold">Berat / ukuran <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="berat_ukuran" id="berat_ukuran" value="{{ old('berat_ukuran', $barang->berat_ukuran ?? '') }}" required placeholder="contoh: 500g, 1kg">
                    @error('berat_ukuran') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="lokasi_simpan" class="form-label text-muted small fw-bold">Lokasi simpan <span class="text-danger">*</span></label>
                    <select name="lokasi_simpan" id="lokasi_simpan" class="form-select" required>
                        <option value="">Pilih lokasi simpan</option>
                        @php $opsiLokasi = ['Freezer Depan', 'Freezer Belakang 1', 'Freezer Belakang 2', 'Showcase Utama', 'Rak Kering']; @endphp
                        @foreach ($opsiLokasi as $opt)
                            <option value="{{ $opt }}" {{ (old('lokasi_simpan', $barang->lokasi_simpan ?? '')) == $opt ? 'selected' : '' }}>
                                {{ $opt }}
                            </option>
                        @endforeach
                    </select>
                    @error('lokasi_simpan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label text-muted small fw-bold">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi', $barang->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="{{ route('barang.index') }}" class="btn btn-light border text-muted px-4">Batal</a>
                <button type="submit" class="btn btn-outline-success px-4 fw-medium">{{ isset($barang) ? 'Update Barang' : 'Simpan Barang' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection