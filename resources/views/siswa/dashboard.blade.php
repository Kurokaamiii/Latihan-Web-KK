@extends('siswa.layout')
@section('title', 'Dashboard')
@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="label">Menunggu</div>
        <div class="number">{{ $stats['menunggu'] }}</div>
        <div class="desc">Aspirasi menunggu review</div>
    </div>
    <div class="stat-card">
        <div class="label">Sedang Diproses</div>
        <div class="number">{{ $stats['proses'] }}</div>
        <div class="desc">Aspirasi sedang ditangani</div>
    </div>
    <div class="stat-card">
        <div class="label">Selesai</div>
        <div class="number">{{ $stats['selesai'] }}</div>
        <div class="desc">Aspirasi telah selesai</div>
    </div>
</div>
<div class="section-card">
    <div class="section-header">
        <h3>Aspirasi Terbaru</h3>
        <p>5 aspirasi terakhir yang Anda kirim</p>
    </div>
    @if($terbaru->isEmpty())
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <p>Belum ada aspirasi. Klik "Buat Aspirasi" untuk mulai!</p>
    </div>
    @else
        @foreach($terbaru as $item)
            @include('siswa.partials.aspirasi-item', ['item' => $item])
        @endforeach
    @endif
</div>
@endsection
