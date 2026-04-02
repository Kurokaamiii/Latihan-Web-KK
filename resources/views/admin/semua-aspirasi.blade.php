@extends('admin.layout')
@section('title', 'Semua Aspirasi')
@section('content')
<div class="section-card">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <div><h3>Semua Aspirasi</h3><p>Riwayat lengkap semua aspirasi</p></div>
        @include('admin.partials.filter-status')
    </div>
    @if($aspirasi->isEmpty())
    <div class="empty-state"><i class="fas fa-inbox"></i><p>Belum ada aspirasi masuk.</p></div>
    @else
        @foreach($aspirasi as $item)
            @include('admin.partials.aspirasi-item', ['item' => $item])
        @endforeach
    @endif
</div>
@endsection
