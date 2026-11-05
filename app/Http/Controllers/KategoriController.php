<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriBarang::withCount('barang')->latest()->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:15|unique:kategori_barang,kode_kategori',
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriBarang::create($validated);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori barang baru berhasil ditambahkan!');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori barang berhasil dihapus!');
    }
}