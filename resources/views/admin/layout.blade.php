<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Elextron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            width: 240px; height: 100vh; background: #e5e7eb;
            position: fixed; left: 0; top: 0; padding: 20px 0;
            display: flex; flex-direction: column;
        }
        .sidebar-brand {
            color: #1f2937; font-size: 18px; font-weight: bold;
            padding: 0 20px 20px; border-bottom: 1px solid #d1d5db;
        }
        .sidebar-menu { padding: 20px 0; flex: 1; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 12px;
            color: #4b5563; text-decoration: none;
            padding: 12px 20px; transition: all 0.2s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            color: #1f2937; background: #d1d5db;
            border-left: 3px solid #6b7280;
        }
        .sidebar-menu a i { width: 20px; text-align: center; }
        .main-content { margin-left: 240px; min-height: 100vh; }
        .topbar {
            background: white; padding: 15px 25px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }
        .topbar-title { font-weight: 600; font-size: 16px; color: #1f2937; }
        .topbar-user { display: flex; align-items: center; gap: 10px; color: #555; }
        .content-area { padding: 25px; }
        .table { background: white; border-radius: 12px; overflow: hidden; }
        .alert-success { border-radius: 10px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-bolt me-2" style="color:#6b7280"></i>
        Elextron
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="fas fa-box"></i> Kelola Produk
        </a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list"></i> Semua Pesanan
        </a>
        <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Profile
        </a>
    </div>

    <div style="padding: 20px; border-top: 1px solid #d1d5db;">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:#4b5563; cursor:pointer; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <div class="topbar-title">Admin Elextron</div>
        <div class="topbar-user dropdown">
            <a href="#" class="dropdown-toggle text-decoration-none text-secondary d-flex align-items-center gap-2"
               data-bs-toggle="dropdown">
                <i class="fas fa-user-circle fa-lg"></i>
                {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><h6 class="dropdown-header">{{ auth()->user()->email }}</h6></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
