<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Toko Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1e1e2d !important; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .harga { color: #e83e8c; font-weight: bold; }
        .btn-hapus { background: none; border: none; color: #dc3545; }
        .btn-hapus:hover { color: #a71d2a; }
        .total-box { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 py-3">
    <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">
        <i class="fas fa-bolt me-2" style="color:#e83e8c"></i>Toko Elektronik
    </a>
    <div class="d-flex gap-3 align-items-center">
        <a href="{{ route('cart.index') }}" class="text-white text-decoration-none">
            <i class="fas fa-shopping-cart"></i> Cart ({{ $carts->count() }})
        </a>
        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">
            <i class="fas fa-user"></i> {{ auth()->user()->name }}
        </a>
    </div>
</nav>

<div class="container py-4">
    <h4 class="fw-bold mb-4">🛒 Keranjang Belanja</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($carts->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <p class="text-muted">Keranjang kamu kosong!</p>
            <a href="{{ route('shop.index') }}" class="btn btn-dark rounded-pill px-4">Belanja Sekarang</a>
        </div>
    @else
    <div class="row">
        <div class="col-md-8">
            <div class="card p-3">
                @foreach($carts as $cart)
                <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                    <img src="{{ Storage::url($cart->product->image) }}" class="product-img">
                    <div class="flex-grow-1">
                        <h6 class="mb-1">{{ $cart->product->title }}</h6>
                        <div class="harga">
                            Rp {{ number_format($cart->product->discount_price ?? $cart->product->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <form action="{{ route('cart.update', $cart) }}" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="form-control w-25" onchange="this.form.submit()">
                    </form>
                    <div class="fw-bold">
                        Rp {{ number_format(($cart->product->discount_price ?? $cart->product->price) * $cart->quantity, 0, ',', '.') }}
                    </div>
                    <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-hapus"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="total-box">
                <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total Produk</span>
                    <span>{{ $carts->count() }} item</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total Harga</span>
                    <span class="harga">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('shop.index') }}" class="btn btn-outline-dark w-100 mt-3 rounded-pill">
                    Lanjut Belanja
                </a>
                <a href="#" class="btn btn-dark w-100 mt-2 rounded-pill">
                    <i class="fas fa-credit-card me-2"></i>Checkout
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>