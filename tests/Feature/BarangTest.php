<?php

use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows barang without category as tidak berkategori', function () {
    Barang::create([
        'kategori_id' => null,
        'nama_barang' => 'Frozen Nugget',
        'foto_barang' => null,
        'satuan' => 'pcs',
        'jumlah_stok' => 12,
        'stok_minimum' => 5,
        'harga_beli' => 10000,
        'harga_jual' => 15000,
        'berat_ukuran' => '500g',
        'lokasi_simpan' => 'Freezer A1',
        'deskripsi' => 'Nugget ayam beku',
    ]);

    $response = $this->get(route('barang.index'));

    $response->assertOk();
    $response->assertSee('Tidak Berkategori');
});

it('rejects stok minimum greater than jumlah stok', function () {
    $payload = [
        'kategori_id' => null,
        'nama_barang' => 'Frozen Dimsum',
        'foto_barang' => null,
        'satuan' => 'pcs',
        'jumlah_stok' => 5,
        'stok_minimum' => 10,
        'harga_beli' => 12000,
        'harga_jual' => 18000,
        'berat_ukuran' => '400g',
        'lokasi_simpan' => 'Freezer B1',
        'deskripsi' => 'Dimsum ayam beku',
    ];

    $response = $this->from(route('barang.create'))
        ->post(route('barang.store'), $payload);

    $response->assertRedirect(route('barang.create'));
    $response->assertSessionHasErrors(['stok_minimum']);
});
