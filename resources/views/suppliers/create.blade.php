@extends('layouts.app')

@section('title', 'Tambah Supplier - GudangSmart')

@section('content')
    <h4 class="fw-bold mb-4 pb-2 border-bottom">Tambah Supplier Baru</h4>

    @if($errors->any())
        <x-alert type="danger" :message="$errors->first()" />
    @endif

    <div class="card card-mono shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.suppliers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kode Supplier</label>
                        <input type="text" name="kode_supplier" class="form-control border-secondary" value="{{ old('kode_supplier') }}" placeholder="SUP-1001" maxlength="10" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Perusahaan (PT)</label>
                        <input type="text" name="nama_pt" class="form-control border-secondary" value="{{ old('nama_pt') }}" placeholder="PT Maju Jaya" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control border-secondary" value="{{ old('email') }}" placeholder="info@majujaya.com" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Telepon</label>
                        <input type="text" name="telepon" class="form-control border-secondary" value="{{ old('telepon') }}" placeholder="08123456789" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control border-secondary" rows="3" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-mono-black px-4">Simpan Data</button>
                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-mono-gray px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection