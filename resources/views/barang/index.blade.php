@extends('layouts.app')

@section('title', 'Katalog Barang - GudangSmart')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h4 class="fw-bold mb-0">Katalog Barang</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.barang.trash') }}" class="btn btn-outline-dark btn-sm">Tempat Sampah</a>
            <a href="{{ route('admin.barang.create') }}" class="btn btn-dark btn-sm">+ Tambah Barang</a>
        </div>
    </div>

    <x-alert type="success" :message="session('success')" />

    <form action="{{ route('admin.barang.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama barang..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="kategori_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-dark w-100">Filter</button>
            <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Stok</th>
                    <th>Harga Satuan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $item)
                    <tr>
                        <td><span class="badge bg-dark">{{ $item->kode_barang }}</span></td>
                        <td class="fw-semibold">{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->supplier->nama_pt ?? '-' }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.barang.edit', $item->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus sementara barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-dark">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Tidak ada data barang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $barang->links('pagination::bootstrap-5') }}
    </div>
@endsection