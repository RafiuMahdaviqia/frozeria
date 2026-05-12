@extends('app')

@section('content')
<style>
    /* Styling khusus untuk angka berkotak di panduan */
    .step-box {
        display: inline-block;
        width: 22px;
        height: 22px;
        border: 1px solid #ced4da;
        text-align: center;
        line-height: 20px;
        font-size: 0.8rem;
        color: #6c757d;
        border-radius: 2px;
        margin-right: 10px;
    }
    .guide-box {
        border: 1px solid #e9ecef;
        border-radius: 4px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        background-color: #fff;
    }
    .guide-text {
        font-size: 0.9rem;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: flex-start;
    }
    .guide-text:last-child { margin-bottom: 0; }
</style>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4 p-md-5">
        <h5 class="fw-bold mb-4" style="color: #343a40;">Panduan Penggunaan Sistem</h5>

        <div class="guide-box shadow-sm">
            <h6 class="fw-bold mb-3 small" style="color: #495057;">Cara menambah barang baru</h6>
            <div class="guide-text">
                <div><span class="step-box">1</span></div>
                <div>Buka halaman <strong>Dashboard</strong>, klik tombol <strong>+ Tambah Barang</strong> di kanan atas.</div>
            </div>
            <div class="guide-text">
                <div><span class="step-box">2</span></div>
                <div>Unggah foto barang (opsional), lalu isi formulir: nama, kategori, satuan, jumlah stok, harga, dan lainnya.</div>
            </div>
            <div class="guide-text">
                <div><span class="step-box">3</span></div>
                <div>Klik <strong>Simpan Barang</strong>. Barang akan muncul di daftar dashboard.</div>
            </div>
        </div>

        <div class="guide-box shadow-sm">
            <h6 class="fw-bold mb-3 small" style="color: #495057;">Cara update stok barang masuk</h6>
            <div class="guide-text">
                <div><span class="step-box">1</span></div>
                <div>Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.</div>
            </div>
            <div class="guide-text">
                <div><span class="step-box">2</span></div>
                <div>Klik tombol <strong>Edit</strong> pada baris barang tersebut.</div>
            </div>
            <div class="guide-text">
                <div><span class="step-box">3</span></div>
                <div>Ubah nilai <strong>Jumlah stok</strong> sesuai kondisi saat ini, lalu klik <strong>Simpan Barang</strong>.</div>
            </div>
        </div>

        <div class="guide-box shadow-sm">
            <h6 class="fw-bold mb-3 small" style="color: #495057;">Cara mengelola kategori</h6>
            <div class="guide-text">
                <div><span class="step-box">1</span></div>
                <div>Buka halaman <strong>Kategori</strong> dari navigasi atas.</div>
            </div>
            <div class="guide-text">
                <div><span class="step-box">2</span></div>
                <div>Tambah, edit, atau hapus kategori sesuai kebutuhan toko.</div>
            </div>
            <div class="guide-text">
                <div><span class="step-box">3</span></div>
                <div>Menghapus kategori tidak akan menghapus barang — barang akan menjadi tidak berkategori.</div>
            </div>
        </div>

        <div class="guide-box shadow-sm d-flex align-items-center bg-light">
            <i class="bi bi-info-circle text-muted me-3 fs-5"></i>
            <span class="small text-muted">Satuan barang diisi bebas sesuai kebutuhan — misalnya: <strong>pcs, pack, box, kg, liter</strong>, dan lain-lain.</span>
        </div>

    </div>
</div>

<div class="card shadow-sm border-0 mb-5">
    <div class="card-body text-center py-4">
        <hr class="text-muted opacity-25 w-75 mx-auto mb-4">
        <p class="text-muted small mb-0">
            Dikembangkan oleh <strong>Rafi'u Mahdaviqia</strong> | NIM: 2241760133 | Kelas: D4 Sistem Informasi Bisnis
        </p>
        <hr class="text-muted opacity-25 w-75 mx-auto mt-4">
    </div>
</div>
@endsection