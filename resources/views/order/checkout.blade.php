<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Elextron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1e1e2d !important; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .harga { color: #e83e8c; font-weight: bold; }
        .btn-checkout { background: #1e1e2d; color: white; border: none; border-radius: 8px; padding: 12px 30px; }
        .btn-checkout:hover { background: #e83e8c; color: white; }
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 py-3">
    <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">
        <i class="fas fa-bolt me-2" style="color:#e83e8c"></i>Elextron
    </a>
</nav>

<div class="container py-4">
    <h4 class="fw-bold mb-4">Checkout</h4>

    <div class="row">
        <div class="col-md-7">
            <div class="card p-4 mb-3">
                <h5 class="fw-bold mb-3">Informasi Pengiriman</h5>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Jalan, Kelurahan, Kecamatan, Kota" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="transfer">Dana</option>
                            <option value="transfer">Gopay</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cod">COD (Bayar di Tempat)</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-checkout w-100">
                        <i class="fas fa-check me-2"></i>Buat Pesanan
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                @foreach($carts as $cart)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ Storage::url($cart->product->image) }}" class="product-img">
                    <div class="flex-grow-1">
                        <div class="fw-bold small">{{ $cart->product->title }}</div>
                        <div class="text-muted small">{{ $cart->quantity }} x Rp {{ number_format($cart->product->discount_price ?? $cart->product->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="harga small">
                        Rp {{ number_format(($cart->product->discount_price ?? $cart->product->price) * $cart->quantity, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span class="harga">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
