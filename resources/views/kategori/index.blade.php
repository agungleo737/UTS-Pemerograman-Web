@extends('layouts.app')

@section('title', 'Kategori Barang - GudangSmart')

@section('content')
    @php $isManager = auth()->user()->role === 'manager'; @endphp

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h4 class="fw-bold mb-0">Manajemen Kategori Barang</h4>
    </div>

    <x-alert type="success" :message="session('success')" />
    @if($errors->any())
        <x-alert type="danger" :message="$errors->first()" />
    @endif

    <div class="row g-4">
        @if($isManager)
            <div class="col-md-4">
                <div class="card border-secondary shadow-sm">
                    <div class="card-header bg-dark text-white fw-bold">
                        + Tambah Kategori Baru
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Kode Kategori</label>
                                <input type="text" name="kode_kategori" class="form-control border-secondary" value="{{ old('kode_kategori') }}" placeholder="Contoh: KAT-006" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control border-secondary" value="{{ old('nama_kategori') }}" placeholder="Contoh: Alat Berat" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Simpan Kategori</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="{{ $isManager ? 'col-md-8' : 'col-12' }}">
            <div class="card border-secondary shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">Kode</th>
                                <th>Nama Kategori</th>
                                <th class="text-center">Jumlah Jenis Barang</th>
                                @if($isManager)
                                    <th class="text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $kat)
                                <tr>
                                    <td class="ps-3"><span class="badge bg-dark">{{ $kat->kode_kategori }}</span></td>
                                    <td class="fw-semibold">{{ $kat->nama_kategori }}</td>
                                    <td class="text-center"><span class="badge bg-secondary">{{ $kat->barang_count }} Item</span></td>
                                    @if($isManager)
                                        <td class="text-center">
                                            <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-dark">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $isManager ? 4 : 3 }}" class="text-center text-muted py-4">Belum ada kategori barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection