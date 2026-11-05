<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MutasiStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasi = MutasiStok::with(['barang', 'user'])->latest()->paginate(10);
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('mutasi.index', compact('mutasi', 'barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id'  => 'required|exists:barang,id',
            'tipe'       => 'required|in:masuk,keluar',
            'jumlah'     => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($data) {
                $barang = Barang::lockForUpdate()->findOrFail($data['barang_id']);

                if ($data['tipe'] === 'keluar' && $barang->stok < $data['jumlah']) {
                    throw new \RuntimeException("Stok {$barang->nama_barang} tidak cukup (tersisa {$barang->stok}).");
                }

                $barang->stok += $data['tipe'] === 'masuk' ? $data['jumlah'] : -$data['jumlah'];
                $barang->save();

                MutasiStok::create($data + ['user_id' => auth()->id()]);
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->withErrors(['jumlah' => $e->getMessage()]);
        }

        return redirect()->route('admin.mutasi.index')->with('success', 'Mutasi stok berhasil dicatat!');
    }
}