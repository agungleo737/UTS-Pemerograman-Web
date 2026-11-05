<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Supplier;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with(['supplier', 'kategori']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barang = $query->latest()->paginate(10)->withQueryString();
        $kategoris = KategoriBarang::all();

        return view('barang.index', compact('barang', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriBarang::all();
        $suppliers = Supplier::all();
        return view('barang.create', compact('kategoris', 'suppliers'));
    }

    public function store(StoreBarangRequest $request)
    {
        Barang::create($request->validated());
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        return redirect()->route('admin.barang.index');
    }

    public function edit(string $id)
    {
        $barang    = Barang::findOrFail($id);
        $kategoris = KategoriBarang::all();
        $suppliers = Supplier::all();
        return view('barang.edit', compact('barang', 'kategoris', 'suppliers'));
    }

    public function update(UpdateBarangRequest $request, string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->validated());
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang dipindahkan ke tempat sampah!');
    }

    public function trash()
    {
        $barang = Barang::onlyTrashed()->with(['supplier', 'kategori'])->paginate(10);
        return view('barang.trash', compact('barang'));
    }

    public function restore(string $id)
    {
        $barang = Barang::onlyTrashed()->findOrFail($id);
        $barang->restore();
        return redirect()->route('admin.barang.trash')->with('success', 'Barang berhasil dipulihkan!');
    }

    public function forceDelete(string $id)
    {
        $barang = Barang::onlyTrashed()->findOrFail($id);
        $barang->forceDelete();
        return redirect()->route('admin.barang.trash')->with('success', 'Barang dihapus permanen!');
    }
}