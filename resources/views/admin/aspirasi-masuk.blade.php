@extends('admin.layout')
@section('title', 'Aspirasi Masuk')
@section('content')
<div class="section-card">
    <div class="section-header"><h3>Aspirasi Masuk</h3><p>Aspirasi yang belum diproses</p></div>
    @if($aspirasi->isEmpty())
    <div class="empty-state"><i class="fas fa-check-circle" style="color:#4caf50;"></i><p>Tidak ada aspirasi yang menunggu!</p></div>
    @else
        @foreach($aspirasi as $item)
            @include('admin.partials.aspirasi-item', ['item' => $item])
        @endforeach
    @endif
</div>
@endsection
