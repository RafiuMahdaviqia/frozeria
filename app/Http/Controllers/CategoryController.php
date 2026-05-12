<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()
            ->withCount('barangs')
            ->get();

        return view('kategori.index', compact('categories'));
    }

    public function create(): View
    {
        return view('kategori.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:categories,nama_kategori'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Category::create($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // PERBAIKAN: Ubah $category menjadi $kategori
    public function edit(Category $kategori): View
    {
        // PERBAIKAN: Ubah compact menjadi 'kategori'
        return view('kategori.form', compact('kategori'));
    }

    // PERBAIKAN: Ubah $category menjadi $kategori
    public function update(Request $request, Category $kategori): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:categories,nama_kategori,'.$kategori->id],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // PERBAIKAN: Ubah $category menjadi $kategori
    public function destroy(Category $kategori): RedirectResponse
    {
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}