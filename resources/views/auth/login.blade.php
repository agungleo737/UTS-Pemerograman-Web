<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GudangSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #18181b;
            color: #18181b;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .login-card {
            background-color: #ffffff;
            border: 1px solid #3f3f46;
            border-radius: 10px;
        }
        .btn-mono-black {
            background-color: #111111;
            color: #ffffff;
            border: none;
        }
        .btn-mono-black:hover {
            background-color: #3f3f46;
            color: #ffffff;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">

    <div class="card login-card shadow-lg p-4" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4 pb-2 border-bottom">
            <h3 class="fw-bold tracking-wide mb-1">▪ GUDANG<span class="fw-light text-secondary">SMART</span></h3>
            <p class="text-secondary small mb-0">Sistem Manufaktur &amp; Inventory Gudang</p>
        </div>

        <x-alert type="danger" :message="session('error')" />
        <x-alert type="success" :message="session('success')" />

        @if($errors->any())
            <x-alert type="danger" :message="$errors->first()" />
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold small text-uppercase text-secondary">Email</label>
                <input type="email" name="email" class="form-control border-secondary" value="{{ old('email') }}" placeholder="manager@gudangsmart.com" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small text-uppercase text-secondary">Password</label>
                <input type="password" name="password" class="form-control border-secondary" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-mono-black w-100 py-2 fw-bold">MASUK KE SISTEM</button>
        </form>

        <div class="mt-4 pt-3 border-top small text-secondary" style="background-color: #f4f4f5; padding: 10px; border-radius: 6px;">
            <strong class="text-dark">Akun Pengujian:</strong><br>
            • Manager: <code class="text-dark">manager@gudangsmart.com</code> | <code class="text-dark">password123</code><br>
            • Staff: <code class="text-dark">staff@gudangsmart.com</code> | <code class="text-dark">password123</code>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>