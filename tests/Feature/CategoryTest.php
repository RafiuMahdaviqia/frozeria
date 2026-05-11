<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('rejects duplicate category names', function () {
    Category::create([
        'nama_kategori' => 'Seafood',
        'deskripsi' => 'Produk laut beku',
    ]);

    $response = $this->from(route('kategori.create'))
        ->post(route('kategori.store'), [
            'nama_kategori' => 'Seafood',
            'deskripsi' => 'Duplikasi kategori',
        ]);

    $response->assertRedirect(route('kategori.create'));
    $response->assertSessionHasErrors(['nama_kategori']);
});
