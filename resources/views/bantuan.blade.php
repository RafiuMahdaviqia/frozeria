@extends('app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Bantuan</h3>
    </div>
    <div class="card-body">
        <h4>Selamat Datang di Sistem Manajemen Stok Frozeria</h4>
        <p>Aplikasi ini dirancang untuk memudahkan pengelolaan inventaris barang di toko Frozeria.</p>

        <h5 class="mt-4">Fitur Utama:</h5>
        <ul>
            <li><strong>Dashboard:</strong> Lihat ringkasan stok barang, barang yang menipis, dan barang yang habis.</li>
            <li><strong>Manajemen Kategori:</strong> Buat, edit, dan hapus kategori barang.</li>
            <li><strong>Manajemen Barang:</strong> Tambah, edit, dan hapus data barang beserta foto dan informasi stok.</li>
            <li><strong>Pencarian & Filter:</strong> Cari barang berdasarkan nama dan filter berdasarkan kategori.</li>
        </ul>

        <h5 class="mt-4">Panduan Penggunaan:</h5>
        <ol>
            <li>Gunakan menu "Kategori" untuk mengelola kategori barang terlebih dahulu.</li>
            <li>Gunakan menu "Dashboard" untuk melihat semua barang dan melakukan operasi CRUD.</li>
            <li>Untuk menambah barang, klik tombol "+ Tambah Barang" di dashboard.</li>
            <li>Untuk mengubah atau menghapus barang, gunakan tombol Edit dan Hapus di setiap baris.</li>
        </ol>

        <h5 class="mt-4">Konten Stok:</h5>
        <ul>
            <li><span class="badge bg-danger">Habis</span> = Stok 0 unit</li>
            <li><span class="badge bg-warning">Menipis</span> = Stok lebih dari 0 tapi kurang dari 20 unit</li>
        </ul>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body text-center">
        <hr>
        <p class="text-muted mb-0">Dikembangkan oleh <strong>Rafi'u Mahdaviqia</strong> | NIM: 2241760133 | Kelas: D4 Sistem Informasi Bisnis</p>
    </div>
</div>
@endsection