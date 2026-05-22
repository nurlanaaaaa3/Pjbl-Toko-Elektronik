<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} - Toko Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1e1e2d !important; }
        .product-img { border-radius: 12px; width: 100%; object-fit: cover; max-height: 400px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .harga { color: #e83e8c; font-weight: bold; font-size: 28px; }
        .harga-coret { color: #aaa; text-decoration: line-through; font-size: 16px; }
        .btn-cart { background: #1e1e2d; color: white; border: none; border-radius: 8px; padding: 12px 30px; }
        .btn-cart:hover { background: #e83e8c; color: white; }
        .badge-kategori { background: #e8f4fd; color: #0d6efd; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 py-3">
    <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">
        <i class="fas fa-bolt me-2" style="color:#e83e8c"></i>Toko Elektronik
    </a>
    <div class="d-flex gap-3 align-items-center">
        <a href="{{ route('shop.index') }}" class="text-white text-decoration-none">
            <i class="fas fa-store"></i> Toko
        </a>
        @auth
        <a href="{{ route('order.history') }}" class="text-white text-decoration-none">
            <i class="fas fa-box"></i> Pesanan
        </a>
        <span class="text-white">
            <i class="fas fa-user"></i> {{ auth()->user()->name }}
        </span>
        {{-- ✅ Ganti ke user.logout --}}
        <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
        </form>
        @else
        {{-- ✅ Ganti ke user.login dan user.register --}}
        <a href="{{ route('user.login') }}" class="text-white text-decoration-none">Login</a>
        <a href="{{ route('user.register') }}" class="text-white text-decoration-none">Register</a>
        @endauth
    </div>
</nav>

<div class="container py-4">
    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <div class="row">
            <div class="col-md-5">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="product-img" alt="{{ $product->title }}">
                @else
                    <img src="https://via.placeholder.com/400x400?text=No+Image" class="product-img" alt="No Image">
                @endif
            </div>
            <div class="col-md-7">
                <span class="badge badge-kategori mb-2">{{ $product->category->name }}</span>
                <h2 class="fw-bold">{{ $product->title }}</h2>
                @if($product->brand)
                    <p class="text-muted">Brand: <strong>{{ $product->brand }}</strong></p>
                @endif

                @if($product->discount_price)
                    <div class="harga-coret">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="harga">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</div>
                @else
                    <div class="harga">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                @endif

                <p class="mt-2 text-muted">Stok tersedia: <strong>{{ $product->stock }}</strong></p>

                <hr>
                <h6 class="fw-bold">Deskripsi Produk</h6>
                <p class="text-muted">{{ $product->description }}</p>

                @auth
                <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <label class="fw-bold">Jumlah:</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control w-25">
                    </div>
                    <button type="submit" class="btn btn-cart">
                        <i class="fas fa-shopping-cart me-2"></i> Tambah ke Cart
                    </button>
                </form>
                @else
                {{-- ✅ Ganti ke user.login --}}
                <div class="alert alert-warning mt-3">
                    <a href="{{ route('user.login') }}">Login</a> terlebih dahulu untuk menambah ke cart.
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>