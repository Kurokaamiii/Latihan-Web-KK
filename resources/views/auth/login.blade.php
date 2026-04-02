<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aspirasi Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Montserrat',sans-serif; background:#e8f5e9; min-height:100vh; display:flex; align-items:center; justify-content:center; }
        .card { background:white; border-radius:16px; padding:2.5rem; width:100%; max-width:420px; box-shadow:0 4px 24px rgba(0,0,0,0.08); }
        .logo { text-align:center; margin-bottom:1.5rem; }
        .logo i { font-size:2.5rem; color:#2e7d32; }
        .logo h2 { font-size:1.3rem; font-weight:700; color:#2e7d32; margin-top:.5rem; }
        .logo p { font-size:.82rem; color:#888; margin-top:.25rem; }
        .tabs { display:flex; background:#f5f5f5; border-radius:10px; padding:4px; margin-bottom:1.5rem; }
        .tab { flex:1; padding:.6rem; text-align:center; border-radius:8px; font-size:.85rem; font-weight:600; cursor:pointer; border:none; background:transparent; color:#888; transition:all .2s; }
        .tab.active { background:white; color:#2e7d32; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
        .form-group { margin-bottom:1rem; }
        .form-label { font-size:.82rem; font-weight:600; color:#444; display:block; margin-bottom:.4rem; }
        .form-control { width:100%; padding:.7rem 1rem; border:1.5px solid #e0e0e0; border-radius:8px; font-family:inherit; font-size:.875rem; outline:none; transition:border .2s; }
        .form-control:focus { border-color:#2e7d32; }
        .btn-login { width:100%; padding:.8rem; background:#2e7d32; color:white; border:none; border-radius:8px; font-family:inherit; font-size:.9rem; font-weight:600; cursor:pointer; margin-top:.5rem; }
        .btn-login:hover { background:#1b5e20; }
        .error { background:#fef2f2; border:1px solid #fecaca; color:#b91c1c; border-radius:8px; padding:.7rem 1rem; font-size:.82rem; margin-bottom:1rem; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <i class="fas fa-bullhorn"></i>
        <h2>Aspirasi Siswa</h2>
        <p>Sampaikan aspirasi Anda</p>
    </div>
    <div class="tabs">
        <button class="tab {{ old('role','siswa') === 'siswa' ? 'active' : '' }}" onclick="switchTab('siswa')">Siswa</button>
        <button class="tab {{ old('role') === 'admin' ? 'active' : '' }}" onclick="switchTab('admin')">Admin</button>
    </div>
    @if($errors->has('login'))
    <div class="error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('login') }}</div>
    @endif
    <form id="form-siswa" method="POST" action="{{ route('login.siswa') }}" style="{{ old('role','siswa') === 'admin' ? 'display:none' : '' }}">
        @csrf
        <input type="hidden" name="role" value="siswa">
        <div class="form-group">
            <label class="form-label">NIS</label>
            <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS" value="{{ old('nis') }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn-login">Login Siswa</button>
    </form>
    <form id="form-admin" method="POST" action="{{ route('login.admin') }}" style="{{ old('role') === 'admin' ? '' : 'display:none' }}">
        @csrf
        <input type="hidden" name="role" value="admin">
        <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn-login">Login Admin</button>
    </form>
</div>
<script>
function switchTab(role) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');
    document.getElementById('form-siswa').style.display = role === 'siswa' ? '' : 'none';
    document.getElementById('form-admin').style.display = role === 'admin' ? '' : 'none';
}
</script>
</body>
</html>
