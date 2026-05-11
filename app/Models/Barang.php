<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'foto_barang',
        'satuan',
        'jumlah_stok',
        'stok_minimum',
        'harga_beli',
        'harga_jual',
        'berat_ukuran',
        'lokasi_simpan',
        'deskripsi',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
