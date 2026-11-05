@extends('layouts.app')

@section('title', 'Tambah Barang - GudangSmart')

@section('content')
    <h4 class="fw-bold mb-4 pb-2 border-bottom">Tambah Barang Baru</h4>

    @if($errors->any())
        <x-alert type="danger" :message="$errors->first()" />
    @endif

    <div class="card card-mono shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.barang.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control border-secondary" value="{{ old('kode_barang') }}" placeholder="BRG-0001" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control border-secondary" value="{{ old('nama_barang') }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kategori Barang</label>
                        <select name="kategori_id" class="form-select border-secondary" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Supplier</label>
                        <select name="supplier_id" class="form-select border-secondary" required>
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>{{ $sup->nama_pt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Stok Awal</label>
                        <input type="number" name="stok" class="form-control border-secondary" value="{{ old('stok', 0) }}" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                        <input type="number" name="harga_satuan" class="form-control border-secondary" value="{{ old('harga_satuan') }}" min="0" required>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-mono-black px-4">Simpan Data</button>
                    <a href="{{ route('admin.barang.index') }}" class="btn btn-mono-gray px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection