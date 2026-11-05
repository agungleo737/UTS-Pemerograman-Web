@extends('layouts.app')

@section('title', 'Mutasi Stok - GudangSmart')

@section('content')
    <h4 class="fw-bold mb-4 pb-2 border-bottom">Mutasi Stok</h4>

    <x-alert type="success" :message="session('success')" />

    @if($errors->any())
        <x-alert type="danger" :message="$errors->first()" />
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3">Catat Barang Masuk / Keluar</h6>
            <form action="{{ route('admin.mutasi.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Barang</label>
                    <select name="barang_id" class="form-select" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->kode_barang }} - {{ $b->nama_barang }} (stok: {{ $b->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Tipe</label>
                    <select name="tipe" class="form-select" required>
                        <option value="masuk" {{ old('tipe') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="keluar" {{ old('tipe') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" min="1" value="{{ old('jumlah') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}" placeholder="Opsional">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark px-4">Simpan Mutasi</button>
                </div>
            </form>
        </div>
    </div>

    <h6 class="fw-bold mb-3">Riwayat Mutasi</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mutasi as $m)
                    <tr>
                        <td>{{ $m->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $m->barang->kode_barang ?? '-' }} - {{ $m->barang->nama_barang ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $m->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($m->tipe) }}
                            </span>
                        </td>
                        <td>{{ $m->tipe === 'masuk' ? '+' : '-' }}{{ $m->jumlah }}</td>
                        <td>{{ $m->keterangan ?? '-' }}</td>
                        <td>{{ $m->user->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada mutasi stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $mutasi->links('pagination::bootstrap-5') }}
    </div>
@endsection