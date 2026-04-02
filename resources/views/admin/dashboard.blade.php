@extends('admin.layout')
@section('title', 'Dashboard Admin')
@section('content')
<div class="stats-grid">
    <div class="stat-card"><div class="label">Menunggu</div><div class="number">{{ $stats['menunggu'] }}</div><div class="desc">Belum diproses</div></div>
    <div class="stat-card"><div class="label">Sedang Diproses</div><div class="number">{{ $stats['proses'] }}</div><div class="desc">Dalam penanganan</div></div>
    <div class="stat-card"><div class="label">Selesai</div><div class="number">{{ $stats['selesai'] }}</div><div class="desc">Telah diselesaikan</div></div>
    <div class="stat-card"><div class="label">Total</div><div class="number">{{ $stats['total'] }}</div><div class="desc">Semua aspirasi</div></div>
</div>
<div class="section-card">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <div><h3>Daftar Aspirasi</h3><p>Semua aspirasi yang masuk</p></div>
        @include('admin.partials.filter-status')
    </div>
    @if($aspirasi->isEmpty())
    <div class="empty-state"><i class="fas fa-check-circle" style="color:#4caf50;"></i><p>Belum ada aspirasi masuk.</p></div>
    @else
        @foreach($aspirasi as $item)
            @include('admin.partials.aspirasi-item', ['item' => $item])
        @endforeach
    @endif
</div>
@endsection
