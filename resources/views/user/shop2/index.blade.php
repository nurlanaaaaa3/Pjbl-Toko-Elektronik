<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elextron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1e1e2d !important; }
        .product-card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-4px); }
        .product-card img { border-radius: 12px 12px 0 0; height: 200px; object-fit: cover; }
        .badge-kategori { background: #e8f4fd; color: #0d6efd; font-size: 11px; }
        .harga { color: #e83e8c; font-weight: bold; font-size: 18px; }
        .harga-coret { color: #aaa; text-decoration: line-through; font-size: 13px; }
        .btn-cart { background: #1e1e2d; color: white; border: none; border-radius: 8px; }
        .btn-cart:hover { background: #e83e8c; color: white; }
        .search-box { border-radius: 20px; border: 1px solid #ddd; padding: 8px 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 py-3">
    <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">
        <i class="fas fa-bolt me-2" style="color:#e83e8c"></i>Elextron
    </a>
    <div class="d-flex gap-3 align-items-center">
        @auth
        <a href="{{ route('order.history') }}" class="text-white text-decoration-none">
            <i class="fas fa-list"></i> Pesanan
        </a>
        <a href="{{ route('cart.index') }}" class="text-white text-decoration-none">
            <i class="fas fa-shopping-cart"></i> Keranjang
        </a>
        <span class="text-white">
            <i class="fas fa-user"></i> {{ auth()->user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a>
        <a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a>
        @endauth
    </div>
</nav>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('shop.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control search-box" placeholder="Cari produk..." value="{{ request('search') }}">
                    <button class="btn btn-dark ms-2 rounded-pill px-4" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('shop.index') }}">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-3">
            <div class="card product-card h-100">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}">
                @else
                    <img src="https://via.placeholder.com/400x200?text=No+Image" alt="No Image">
                @endif
                <div class="card-body">
                    <span class="badge badge-kategori mb-2">{{ $product->category->name }}</span>
                    <h6 class="card-title">{{ $product->title }}</h6>
                    @if($product->discount_price)
                        <div class="harga-coret">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="harga">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</div>
                    @else
                        <div class="harga">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @endif
                    <p class="text-muted small mt-1">Stok: {{ $product->stock }}</p>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <a href="{{ route('shop.show', $product) }}" class="btn btn-cart w-100">
                        <i class="fas fa-eye me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <p class="text-muted">Produk Tidak Ditemukan</p>
        </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
