@extends('layouts.app')

@section('title', 'Data Supplier - GudangSmart')

@section('content')
    @php $isManager = auth()->user()->role === 'manager'; @endphp

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h4 class="fw-bold mb-0">Manajemen Data Pemasok (Supplier)</h4>
        @if($isManager)
            <a href="{{ route('admin.suppliers.create') }}" class="btn btn-dark btn-sm">+ Tambah Supplier</a>
        @endif
    </div>

    <x-alert type="success" :message="session('success')" />

    <form action="{{ route('admin.suppliers.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-9">
            <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama PT..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-dark w-100">Cari</button>
            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama PT</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    @if($isManager)
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $sup)
                    <tr>
                        <td><span class="badge bg-dark">{{ $sup->kode_supplier }}</span></td>
                        <td class="fw-semibold">{{ $sup->nama_pt }}</td>
                        <td class="small">
                            {{ $sup->email }}<br>
                            <span class="text-secondary">{{ $sup->telepon }}</span>
                        </td>
                        <td class="small text-secondary">{{ $sup->alamat }}</td>
                        @if($isManager)
                            <td class="text-center">
                                <a href="{{ route('admin.suppliers.edit', $sup->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('admin.suppliers.destroy', $sup->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus supplier ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-dark">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $isManager ? 5 : 4 }}" class="text-center text-muted py-4">Belum ada data supplier.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $suppliers->links('pagination::bootstrap-5') }}
    </div>
@endsection