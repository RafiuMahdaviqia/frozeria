<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request): View
    {
        $query = Barang::with('category');

        if ($request->search) {
            $query->where('nama_barang', 'like', '%'.$request->search.'%');
        }

        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->latest()->paginate(10)->withQueryString();

        $totalBarang = Barang::count();
        $totalKategori = Category::count();
        $stokMenipis = Barang::where('jumlah_stok', '<', 20)
            ->where('jumlah_stok', '>', 0)
            ->count();
        $stokHabis = Barang::where('jumlah_stok', 0)->count();

        $categories = Category::all();

        return view('dashboard', compact('barangs', 'totalBarang', 'totalKategori', 'stokMenipis', 'stokHabis', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('barang.form', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['nullable', 'exists:categories,id'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'foto_barang' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'satuan' => ['required', 'string', 'max:255'],
            // Tambahkan min:0 untuk memblokir angka minus
            'jumlah_stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'harga_beli' => ['required', 'integer', 'min:0'],
            'harga_jual' => ['required', 'integer', 'min:0', 'gte:harga_beli'],
            'berat_ukuran' => ['required', 'string', 'max:255'],
            'lokasi_simpan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $path = null;

        if ($request->hasFile('foto_barang')) {
            $path = $request->file('foto_barang')->store('fotos', 'public');
        }

        $validated['foto_barang'] = $path;

        Barang::create($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang): View
    {
        return view('barang.detail', compact('barang'));
    }

    public function edit(Barang $barang): View
    {
        $categories = Category::all();

        return view('barang.form', compact('barang', 'categories'));
    }

    public function update(Request $request, Barang $barang): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['nullable', 'exists:categories,id'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'foto_barang' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'satuan' => ['required', 'string', 'max:255'],
            // Tambahkan min:0 untuk memblokir angka minus
            'jumlah_stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'harga_beli' => ['required', 'integer', 'min:0'],
            'harga_jual' => ['required', 'integer', 'min:0', 'gte:harga_beli'],
            'berat_ukuran' => ['required', 'string', 'max:255'],
            'lokasi_simpan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto_barang')) {
            if ($barang->foto_barang) {
                Storage::disk('public')->delete($barang->foto_barang);
            }

            $validated['foto_barang'] = $request->file('foto_barang')->store('fotos', 'public');
        } else {
            unset($validated['foto_barang']);
        }

        $barang->update($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang): RedirectResponse
    {
        if ($barang->foto_barang) {
            Storage::disk('public')->delete($barang->foto_barang);
        }

        $barang->delete();

        return back()->with('success', 'Barang berhasil dihapus.');
    }
}
