<div class="bg-white border-end p-3" style="width: 250px; min-height: calc(100vh - 60px);">
    <div class="text-uppercase text-secondary small fw-bold mb-3 px-2" style="letter-spacing: 1px;">
        Navigasi Utama
    </div>
    <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'bg-dark text-white fw-semibold' : 'text-dark' }}">
                Dashboard
            </a>
        </li>

        @if(auth()->user()->role === 'manager')
            <li class="nav-item">
                <a href="{{ route('admin.suppliers.index') }}"
                   class="nav-link {{ request()->routeIs('admin.suppliers.*') ? 'bg-dark text-white fw-semibold' : 'text-dark' }}">
                    Supplier
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kategori.index') }}"
                   class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'bg-dark text-white fw-semibold' : 'text-dark' }}">
                    Kategori Barang
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('admin.barang.index') }}"
               class="nav-link {{ request()->routeIs('admin.barang.*') ? 'bg-dark text-white fw-semibold' : 'text-dark' }}">
                Katalog Barang
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.mutasi.index') }}"
               class="nav-link {{ request()->routeIs('admin.mutasi.*') ? 'bg-dark text-white fw-semibold' : 'text-dark' }}">
                Mutasi Stok
            </a>
        </li>
    </ul>
</div>