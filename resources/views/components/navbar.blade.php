@props(['user' => 'Administrator', 'status' => 'Terhubung'])

<nav class="navbar navbar-dark bg-mono-black px-4 py-3 border-bottom border-secondary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold tracking-wide text-white" href="{{ route('admin.dashboard') }}">
            ▪ GUDANG<span class="fw-light text-secondary">SMART</span>
        </a>
        <div class="d-flex align-items-center text-light gap-3">
            <span class="badge border border-secondary text-light fw-normal px-2 py-1" style="background-color: #27272a;">
                ● {{ $status }}
            </span>
            <span class="text-secondary">|</span>
            <span class="small">
                <strong class="text-white">{{ auth()->check() ? auth()->user()->name : $user }}</strong>
                @auth
                    <span class="badge bg-light text-dark ms-1">{{ strtoupper(auth()->user()->role) }}</span>
                @endauth
            </span>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Keluar</button>
                </form>
            @endauth
        </div>
    </div>
</nav>