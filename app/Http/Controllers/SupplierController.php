<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pt', 'like', "%{$search}%")
                  ->orWhere('kode_supplier', 'like', "%{$search}%");
            });
        }

        $suppliers = $query->latest()->paginate(10)->withQueryString();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier' => 'required|string|max:10|unique:suppliers,kode_supplier',
            'nama_pt'       => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'telepon'       => 'required|string|max:20',
            'alamat'        => 'required|string',
        ]);

        Supplier::create($validated);

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Data supplier baru berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'kode_supplier' => 'required|string|max:10|unique:suppliers,kode_supplier,' . $supplier->id,
            'nama_pt'       => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'telepon'       => 'required|string|max:20',
            'alamat'        => 'required|string',
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Data supplier berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Data supplier berhasil dihapus!');
    }
}