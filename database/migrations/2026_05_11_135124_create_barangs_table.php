<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('nama_barang');
            $table->string('foto_barang')->nullable();
            $table->string('satuan');
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->string('berat_ukuran');
            $table->string('lokasi_simpan');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
