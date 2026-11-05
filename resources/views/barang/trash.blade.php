@extends('layouts.app')

@section('title', 'Tempat Sampah Barang - GudangSmart')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h4 class="fw-bold mb-0">Tempat Sampah</h4>
        <a href="{{ route('admin.barang.index') }}" class="btn btn-mono-gray btn-sm px-3">&larr; Kembali ke Katalog</a>
    </div>

    <x-alert type="success" :message="session('success')" />

    <div class="card card-mono shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-mono-dark">
                    <tr>
                        <th class="py-3 ps-3">Kode</th>
                        <th class="py-3">Nama Barang</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Supplier</th>
                        <th class="py-3">Waktu Dihapus</th>
                        <th class="py-3 text-center">Aksi Pemulihan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $item)
                        <tr>
                            <td class="ps-3"><span class="badge bg-secondary">{{ $item->kode_barang }}</span></td>
                            <td class="fw-semibold">{{ $item->nama_barang }}</td>
                            <td class="text-secondary">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td class="text-secondary">{{ $item->supplier->nama_pt ?? '-' }}</td>
                            <td class="text-muted small">{{ $item->deleted_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.barang.restore', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-mono-gray">Restore</button>
                                </form>
                                <form action="{{ route('admin.barang.forceDelete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permanen data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-mono-black">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">Tempat sampah kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection