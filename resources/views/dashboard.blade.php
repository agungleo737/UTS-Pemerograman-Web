@extends('layouts.app')

@section('title', 'Dashboard Inventory - GudangSmart')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h4 class="fw-bold mb-0 text-dark">Dashboard Inventory</h4>
            <span class="text-secondary small">Ringkasan Data Gudang</span>
        </div>

        <x-alert type="success" :message="session('success')" />

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-mono-black shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-secondary small fw-bold mb-2">Total Supplier</h6>
                        <h2 class="display-5 fw-bold mb-1 text-white">{{ number_format($totalSupplier, 0, ',', '.') }}</h2>
                        <small class="text-secondary">Pemasok Aktif Terdaftar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-mono-dark shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-secondary small fw-bold mb-2">Total Jenis Barang</h6>
                        <h2 class="display-5 fw-bold mb-1 text-white">{{ number_format($totalJenisBarang, 0, ',', '.') }}</h2>
                        <small class="text-secondary">Item Katalog Gudang</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-mono-gray shadow-sm border-secondary h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-secondary small fw-bold mb-2">Total Stok Fisik Gudang</h6>
                        <h2 class="display-5 fw-bold mb-1 text-dark">{{ number_format($totalStokFisik, 0, ',', '.') }}</h2>
                        <small class="text-secondary">Total Unit Tersedia</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection