@extends('admin.layout')
@section('title', 'Kelola Kategori')
@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;align-items:start;">
    <div class="section-card">
        <div class="section-header"><h3>Tambah Kategori Baru</h3><p>Tambahkan kategori aspirasi baru</p></div>
        <div class="form-wrap">
            @if(session('error'))
            <div style="background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;border-radius:8px;padding:.7rem 1rem;font-size:.85rem;margin-bottom:1rem;">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif
            <form method="POST" action="{{ route('admin.kategori.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="ket_kategori" class="form-control" placeholder="Contoh: Keamanan" value="{{ old('ket_kategori') }}" maxlength="30" required>
                    @error('ket_kategori')<div style="font-size:.78rem;color:#ef5350;margin-top:.3rem;">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn-save" style="width:100%;padding:.7rem;"><i class="fas fa-plus"></i> Tambah Kategori</button>
            </form>
        </div>
    </div>
    <div class="section-card">
        <div class="section-header"><h3>Daftar Kategori</h3><p>Total: {{ $kategori->count() }} kategori</p></div>
        @if($kategori->isEmpty())
        <div class="empty-state"><i class="fas fa-tags"></i><p>Belum ada kategori.</p></div>
        @else
        @foreach($kategori as $kat)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 1.5rem;border-bottom:1px solid #f5f5f5;">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <div style="width:32px;height:32px;background:#e8f5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-tag" style="color:#2e7d32;font-size:.8rem;"></i>
                </div>
                <div>
                    <div style="font-weight:600;font-size:.9rem;color:#222;">{{ $kat->ket_kategori }}</div>
                    <div style="font-size:.75rem;color:#999;">ID: {{ $kat->id_kategori }}</div>
                </div>
            </div>
            @if($kat->id_kategori > 2)
            <form method="POST" action="{{ route('admin.kategori.destroy', $kat->id_kategori) }}" onsubmit="return confirm('Hapus kategori {{ $kat->ket_kategori }}?')">
                @csrf @method('DELETE')
                <button type="submit" style="padding:.35rem .75rem;border:1.5px solid #fecaca;border-radius:8px;background:white;color:#ef5350;font-size:.8rem;font-weight:600;cursor:pointer;font-family:inherit;">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            @else
            <span style="font-size:.75rem;color:#bbb;font-style:italic;">Default</span>
            @endif
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
