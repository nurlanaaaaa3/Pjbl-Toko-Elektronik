<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Elextron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1e1e2d !important; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .success-icon { color: #28a745; font-size: 60px; }
        .harga { color: #e83e8c; font-weight: bold; }
        .badge-status { background: #fff3cd; color: #856404; padding: 6px 12px; border-radius: 20px; font-size: 13px; }
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
            <div class="d-flex gap-3 align-items-center">
        <span class="text-white">
            <i class="fas fa-user"></i> {{ auth()->user()->name }}
        </span>
    </nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-5 text-center">
                <i class="fas fa-check-circle success-icon mb-3"></i>
                <h4 class="fw-bold">Pesanan Berhasil Dibuat!</h4>
                <p class="text-muted">Terima kasih telah berbelanja di Elextron</p>

                <div class="bg-light rounded p-3 mb-4 text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">No. Pesanan</span>
                        <span class="fw-bold">#{{ $order->id }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Nama</span>
                        <span>{{ $order->nama }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Telepon</span>
                        <span>{{ $order->telepon }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Pembayaran</span>
                        <span>{{ ucfirst($order->payment_method) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status</span>
                        <span class="badge-status">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Total</span>
                        <span class="harga">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('order.history') }}" class="btn btn-outline-dark rounded-pill px-4">
                        <i class="fas fa-list me-2"></i>Riwayat Pesanan
                    </a>
                    <a href="{{ route('shop.index') }}" class="btn btn-dark rounded-pill px-4">
                        <i class="fas fa-store me-2"></i>Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
