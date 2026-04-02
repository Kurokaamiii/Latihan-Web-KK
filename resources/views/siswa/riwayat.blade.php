@extends('siswa.layout')
@section('title', 'Riwayat Aspirasi')
@section('content')
<div class="section-card">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <div>
            <h3>Riwayat Aspirasi</h3>
            <p>Semua aspirasi yang pernah Anda kirim</p>
        </div>
        <form method="GET" action="{{ route('siswa.riwayat') }}" style="display:flex;align-items:center;gap:.5rem;">
            <select name="status" class="form-control" style="width:auto;font-size:.82rem;padding:.4rem .75rem;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Proses"   {{ request('status') == 'Proses'   ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="Selesai"  {{ request('status') == 'Selesai'  ? 'selected' : '' }}>Selesai</option>
            </select>
            @if(request('status'))
                <a href="{{ route('siswa.riwayat') }}" style="font-size:.8rem;color:#999;text-decoration:none;">Hapus filter</a>
            @endif
        </form>
    </div>
    @if($aspirasi->isEmpty())
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <p>{{ request('status') ? 'Tidak ada aspirasi dengan status ini.' : 'Belum ada aspirasi.' }}</p>
    </div>
    @else
        @foreach($aspirasi as $item)
            @include('siswa.partials.aspirasi-item', ['item' => $item])
        @endforeach
    @endif
</div>
@endsection
