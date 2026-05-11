@extends('app')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <h2 class="mb-4">Detail Barang</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if ($barang->foto_barang)
                            <img src="{{ Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                                <span class="text-muted">Tidak ada foto</span>
                            </div>
                        @endif
                        <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Barang</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Kategori:</strong></td>
                                <td>
                                    @if ($barang->category)
                                        {{ $barang->category->nama_kategori }}
                                    @else
                                        <span class="badge bg-secondary">Tidak Berkategori</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Satuan:</strong></td>
                                <td>{{ $barang->satuan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Berat/Ukuran:</strong></td>
                                <td>{{ $barang->berat_ukuran }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi Simpan:</strong></td>
                                <td>{{ $barang->lokasi_simpan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Stok</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-muted">Jumlah Stok</h6>
                                    @if ($barang->jumlah_stok == 0)
                                        <h3 class="text-danger">{{ $barang->jumlah_stok }}</h3>
                                    @elseif ($barang->jumlah_stok < 20)
                                        <h3 class="text-warning">{{ $barang->jumlah_stok }}</h3>
                                    @else
                                        <h3 class="text-success">{{ $barang->jumlah_stok }}</h3>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-muted">Stok Minimum</h6>
                                    <h3>{{ $barang->stok_minimum }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-muted">Status</h6>
                                    @if ($barang->jumlah_stok == 0)
                                        <span class="badge bg-danger" style="font-size: 14px;">Habis</span>
                                    @elseif ($barang->jumlah_stok < 20)
                                        <span class="badge bg-warning" style="font-size: 14px;">Menipis</span>
                                    @else
                                        <span class="badge bg-success" style="font-size: 14px;">Normal</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Harga</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Harga Beli:</strong></td>
                                <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Harga Jual:</strong></td>
                                <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Margin Keuntungan:</strong></td>
                                <td>
                                    @php
                                        $margin = $barang->harga_jual - $barang->harga_beli;
                                        $marginPercent = ($margin / $barang->harga_beli) * 100;
                                    @endphp
                                    Rp {{ number_format($margin, 0, ',', '.') }} ({{ number_format($marginPercent, 2, ',', '.') }}%)
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if ($barang->deskripsi)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Deskripsi</h5>
                        </div>
                        <div class="card-body">
                            {{ $barang->deskripsi }}
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-1"></i>Edit Barang
                    </a>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash me-1"></i>Hapus Barang
                    </button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
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
                <p>Apakah Anda yakin ingin menghapus barang "<strong>{{ $barang->nama_barang }}</strong>"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('barang.destroy', $barang) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
