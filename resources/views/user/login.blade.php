<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Elextron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .login-card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .btn-login { background: #1e1e2d; color: white; border: none; border-radius: 8px; padding: 12px; }
        .btn-login:hover { background: #e83e8c; color: white; }
        .brand { color: #1e1e2d; font-weight: bold; font-size: 24px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="text-center mb-4">
                <i class="fas fa-bolt fa-2x" style="color:#e83e8c"></i>
                <div class="brand mt-2">Elextron</div>
                <p class="text-muted">Selamat Datang Sebagai Pelanggan<br>
                    Silahkan Login Untuk Mulai Belanja
                </p>
            </div>

            <div class="card login-card p-4">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@gmail.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label text-muted" for="remember">Ingat Saya</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>

                <hr>
                <div class="text-center">
                    <p class="text-muted mb-1">Belum Punya Akun?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-dark rounded-pill px-4">Daftar</a>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('shop.index') }}" class="text-muted text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Toko
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
