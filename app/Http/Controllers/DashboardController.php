<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalSupplier'    => Supplier::count(),
            'totalJenisBarang' => Barang::count(),
            'totalStokFisik'   => (int) Barang::sum('stok'),
        ]);
    }
}