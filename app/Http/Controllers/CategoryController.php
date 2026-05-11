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

    public function edit(Category $category): View
    {
        return view('kategori.form', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:categories,nama_kategori,'.$category->id],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $category->update($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
