<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aspirasi Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Montserrat',sans-serif; background:#e8f5e9; min-height:100vh; }
        .header { background:#2e7d32; color:white; padding:1rem 2rem; display:flex; align-items:center; justify-content:space-between; }
        .header-left { display:flex; align-items:center; gap:.75rem; }
        .header-left i { font-size:1.5rem; }
        .header-left h1 { font-size:1.1rem; font-weight:700; }
        .header-right { display:flex; align-items:center; gap:1rem; }
        .user-info { font-size:.82rem; text-align:right; }
        .user-info .name { font-weight:600; }
        .user-info .nis { opacity:.8; }
        .btn-logout { padding:.4rem .9rem; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); border-radius:8px; color:white; font-family:inherit; font-size:.8rem; font-weight:600; cursor:pointer; }
        .navbar { background:white; padding:0 2rem; display:flex; gap:.25rem; border-bottom:1px solid #e0e0e0; box-shadow:0 2px 8px rgba(0,0,0,0.04); }
        .nav-tab { padding:.9rem 1.25rem; font-size:.85rem; font-weight:600; color:#777; text-decoration:none; border-bottom:3px solid transparent; transition:all .2s; }
        .nav-tab:hover { color:#2e7d32; }
        .nav-tab.active { color:#2e7d32; border-bottom-color:#2e7d32; }
        .container { max-width:900px; margin:2rem auto; padding:0 1.5rem; }
        .section-card { background:white; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.06); margin-bottom:1.25rem; overflow:hidden; }
        .section-header { padding:1.25rem 1.5rem; border-bottom:1px solid #f5f5f5; }
        .section-header h3 { font-size:1rem; font-weight:700; color:#222; }
        .section-header p { font-size:.8rem; color:#999; margin-top:.2rem; }
        .form-wrap { padding:1.5rem; }
        .form-group { margin-bottom:1rem; }
        .form-label { font-size:.82rem; font-weight:600; color:#444; display:block; margin-bottom:.4rem; }
        .form-control { width:100%; padding:.7rem 1rem; border:1.5px solid #e0e0e0; border-radius:8px; font-family:inherit; font-size:.875rem; outline:none; transition:border .2s; }
        .form-control:focus { border-color:#2e7d32; }
        .form-error { font-size:.78rem; color:#ef5350; margin-top:.3rem; }
        .btn-submit { padding:.75rem 2rem; background:#2e7d32; color:white; border:none; border-radius:8px; font-family:inherit; font-size:.9rem; font-weight:600; cursor:pointer; }
        .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1.25rem; }
        .stat-card { background:white; border-radius:12px; padding:1.25rem 1.5rem; box-shadow:0 2px 12px rgba(0,0,0,0.06); border-left:4px solid #2e7d32; }
        .stat-card .label { font-size:.78rem; font-weight:600; color:#888; text-transform:uppercase; }
        .stat-card .number { font-size:2rem; font-weight:700; color:#2e7d32; margin:.25rem 0; }
        .stat-card .desc { font-size:.75rem; color:#aaa; }
        .aspirasi-item { padding:1.25rem 1.5rem; border-bottom:1px solid #f5f5f5; }
        .aspirasi-item:last-child { border-bottom:none; }
        .aspirasi-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:.5rem; }
        .aspirasi-judul { font-weight:700; font-size:.95rem; color:#222; }
        .badge { padding:.25rem .75rem; border-radius:20px; font-size:.75rem; font-weight:600; }
        .badge-menunggu { background:#fff3e0; color:#e65100; }
        .badge-proses { background:#e3f2fd; color:#1565c0; }
        .badge-selesai { background:#e8f5e9; color:#2e7d32; }
        .aspirasi-meta { display:flex; gap:1rem; font-size:.78rem; color:#999; margin-bottom:.5rem; }
        .kategori-badge { display:inline-block; padding:.2rem .65rem; border:1.5px solid #2e7d32; border-radius:20px; font-size:.75rem; color:#2e7d32; font-weight:600; margin-bottom:.5rem; }
        .aspirasi-ket { font-size:.85rem; color:#555; margin-bottom:.75rem; }
        .btn-foto { display:inline-flex; align-items:center; gap:.4rem; padding:.35rem .85rem; border:1.5px solid #2e7d32; border-radius:8px; color:#2e7d32; font-size:.8rem; font-weight:600; text-decoration:none; margin-bottom:.75rem; }
        .feedback-box { background:#f1f8e9; border-left:3px solid #2e7d32; border-radius:0 8px 8px 0; padding:.75rem 1rem; margin-bottom:.75rem; }
        .feedback-box .fb-title { font-size:.78rem; font-weight:700; color:#2e7d32; margin-bottom:.3rem; }
        .feedback-box p { font-size:.85rem; color:#444; }
        .empty-state { text-align:center; padding:3rem; color:#bbb; }
        .empty-state i { font-size:2.5rem; display:block; margin-bottom:.75rem; }
        .alert-success { background:#f1f8e9; border:1px solid #a5d6a7; color:#2e7d32; border-radius:8px; padding:.7rem 1rem; font-size:.85rem; margin-bottom:1rem; }
    </style>
</head>
<body>
<div class="header">
    <div class="header-left">
        <i class="fas fa-bullhorn"></i>
        <h1>Aspirasi Siswa</h1>
    </div>
    <div class="header-right">
        <div class="user-info">
            <div class="name">{{ Session::get('siswa.username') }}</div>
            <div class="nis">NIS: {{ Session::get('siswa.nis') }} | {{ Session::get('siswa.kelas') }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</div>
<div class="navbar">
    <a href="{{ route('siswa.dashboard') }}" class="nav-tab {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
    <a href="{{ route('siswa.buat') }}" class="nav-tab {{ request()->routeIs('siswa.buat') ? 'active' : '' }}"><i class="fas fa-plus-circle"></i> Buat Aspirasi</a>
    <a href="{{ route('siswa.riwayat') }}" class="nav-tab {{ request()->routeIs('siswa.riwayat') ? 'active' : '' }}"><i class="fas fa-history"></i> Riwayat</a>
</div>
<div class="container">
    @if(session('success'))
    <div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
