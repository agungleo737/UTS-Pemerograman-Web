<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GudangSmart - Sistem Inventory')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f6;
            color: #1a1a1a;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .bg-mono-black {
            background-color: #111111 !important;
            color: #ffffff !important;
        }
        .bg-mono-dark {
            background-color: #262626 !important;
            color: #ffffff !important;
        }
        .bg-mono-gray {
            background-color: #e5e5e5 !important;
            color: #1a1a1a !important;
        }
        .card-mono {
            background-color: #ffffff;
            border: 1px solid #d4d4d8;
            border-radius: 8px;
        }
        .btn-mono-black {
            background-color: #18181b;
            color: #ffffff;
            border: 1px solid #18181b;
        }
        .btn-mono-black:hover {
            background-color: #3f3f46;
            color: #ffffff;
        }
        .btn-mono-outline {
            background-color: transparent;
            color: #27272a;
            border: 1px solid #a1a1aa;
        }
        .btn-mono-outline:hover {
            background-color: #27272a;
            color: #ffffff;
        }
        .btn-mono-gray {
            background-color: #e4e4e7;
            color: #18181b;
            border: 1px solid #d4d4d8;
        }
        .btn-mono-gray:hover {
            background-color: #d4d4d8;
            color: #000000;
        }
        .pagination .page-link {
            color: #18181b;
            border-color: #d4d4d8;
        }
        .pagination .page-item.active .page-link {
            background-color: #18181b;
            border-color: #18181b;
            color: #ffffff;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <x-navbar user="Administrator" status="Online" />
    <div class="d-flex flex-grow-1">
        <x-sidebar />
        <main class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
            @yield('content')
        </main>
    </div>
    <footer class="bg-mono-black text-center py-3 mt-auto border-top border-secondary">
        <small class="text-secondary">&copy; {{ date('Y') }} <strong class="text-white">GudangSmart</strong> — Sistem Manufaktur & Inventory Gudang</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>