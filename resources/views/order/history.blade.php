<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Elextron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1e1e2d !important; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .harga { color: #e83e8c; font-weight: bold; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cfe2ff; color: #084298; }
        .badge-shipped { background: #d1e7dd; color: #0a3622; }
        .badge-done { background: #d1e7dd; color: #0a3622; }
        .badge-cancelled { background: #f8d7da; color: #842029; }
        .product-img { width: 50px; height: 50px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 py-3">
    <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">
        <i class="fas fa-bolt me-2" style="color:#e83e8c"></i>Elextron
    </a>
    <div class="d-flex gap-3 align-items-center">
        <a href="{{ route('shop.index') }}" class="text-white text-decoration-none">
            <i class="fas fa-store"></i> Toko
        </a>
        <span class="text-white">
            <i class="fas fa-user"></i> {{ auth()->user()->name }}
        </span>
    </div>
</nav>

<div class="container py-4">
    <h4 class="fw-bold mb-4">Riwayat Pesanan</h4>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <p class="text-muted">Belum ada pesanan!</p>
            <a href="{{ route('shop.index') }}" class="btn btn-dark rounded-pill px-4">Belanja Sekarang</a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="card p-4 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="fw-bold">Pesanan #{{ $order->id }}</span>
                    <span class="text-muted small ms-2">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <span class="badge badge-{{ $order->status }} px-3 py-2 rounded-pill">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            @foreach($order->items as $item)
            <div class="d-flex align-items-center gap-3 mb-2">
                <img src="{{ Storage::url($item->product->image) }}" class="product-img">
                <div class="flex-grow-1">
                    <div class="fw-bold small">{{ $item->product->title }}</div>
                    <div class="text-muted small">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                </div>
                <div class="harga small">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
            </div>
            @endforeach

            <hr>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Metode: {{ ucfirst($order->payment_method) }}</span>
                <span class="fw-bold harga">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
