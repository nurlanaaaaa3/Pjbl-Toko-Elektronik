@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Semua Pesanan</h4>
            <small class="text-muted">Daftar semua transaksi pelanggan</small>
        </div>
        <span class="badge bg-dark fs-6 px-3 py-2">
            Total: {{ $orders->count() }} pesanan
        </span>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #f59e0b !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;background:#fef3c7;">
                        <i class="fas fa-clock" style="color:#f59e0b;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Pending</div>
                        <div class="fw-bold fs-5">{{ $orders->where('status', 'pending')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #3b82f6 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;background:#dbeafe;">
                        <i class="fas fa-spinner" style="color:#3b82f6;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Diproses</div>
                        <div class="fw-bold fs-5">{{ $orders->where('status', 'proses')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;background:#d1fae5;">
                        <i class="fas fa-check-circle" style="color:#10b981;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Selesai</div>
                        <div class="fw-bold fs-5">{{ $orders->where('status', 'selesai')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #e83e8c !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;background:#fce7f3;">
                        <i class="fas fa-money-bill-wave" style="color:#e83e8c;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Pendapatan</div>
                        <div class="fw-bold fs-5">Rp {{ number_format($orders->where('status', 'selesai')->sum('total'), 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    @if($orders->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">Belum ada pesanan masuk.</p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold">ID</th>
                                <th class="py-3 text-muted fw-semibold">Pembeli</th>
                                <th class="py-3 text-muted fw-semibold">Produk</th>
                                <th class="py-3 text-muted fw-semibold">Total</th>
                                <th class="py-3 text-muted fw-semibold">Status</th>
                                <th class="py-3 text-muted fw-semibold">Tanggal</th>
                                <th class="py-3 text-muted fw-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-4">
                                    <span class="fw-bold text-muted">#{{ $order->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $order->nama }}</div>
                                    <div class="text-muted small">{{ $order->user->email }}</div>
                                </td>
                                <td>
                                    @foreach($order->items as $item)
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="badge bg-light text-dark border">x{{ $item->quantity }}</span>
                                            <span class="small">{{ $item->product->name }}</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="fw-bold" style="color:#e83e8c;">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @if($order->status === 'pending')
                                        <span class="badge rounded-pill px-3 py-2"
                                            style="background:#fef3c7;color:#92400e;">
                                            <i class="fas fa-clock me-1"></i> Pending
                                        </span>
                                    @elseif($order->status === 'proses')
                                        <span class="badge rounded-pill px-3 py-2"
                                            style="background:#dbeafe;color:#1e40af;">
                                            <i class="fas fa-spinner me-1"></i> Diproses
                                        </span>
                                    @elseif($order->status === 'selesai')
                                        <span class="badge rounded-pill px-3 py-2"
                                            style="background:#d1fae5;color:#065f46;">
                                            <i class="fas fa-check-circle me-1"></i> Selesai
                                        </span>
                                    @elseif($order->status === 'dibatalkan')
                                        <span class="badge rounded-pill px-3 py-2"
                                            style="background:#fee2e2;color:#991b1b;">
                                            <i class="fas fa-times-circle me-1"></i> Dibatalkan
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2 bg-secondary">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">{{ $order->created_at->format('d/m/Y') }}</div>
                                    <div class="text-muted small">{{ $order->created_at->format('H:i') }}</div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm" style="width:130px;">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ $order->status === 'proses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-dark">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
