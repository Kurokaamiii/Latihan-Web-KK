<div class="aspirasi-item">
    <div class="aspirasi-top">
        <div class="aspirasi-judul">{{ $item->ket }}</div>
        <span class="badge badge-{{ $item->status === 'Proses' ? 'proses' : ($item->status === 'Selesai' ? 'selesai' : 'menunggu') }}">
            {{ $item->status === 'Proses' ? 'Sedang Diproses' : $item->status }}
        </span>
    </div>
    <div class="aspirasi-meta">
        <span><i class="fas fa-calendar"></i> {{ $item->created_at->format('Y-m-d') }}</span>
        <span><i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}</span>
    </div>
    @if($item->kategori)
    <div><span class="kategori-badge">{{ $item->kategori->ket_kategori }}</span></div>
    @endif
    @if($item->aspirasi && $item->aspirasi->feedback)
    <div class="feedback-box">
        <div class="fb-title"><i class="fas fa-comment"></i> Feedback Dari Admin:</div>
        <p>{{ $item->aspirasi->feedback }}</p>
        @if($item->aspirasi->rating)
        <div style="margin-top:.6rem;display:flex;align-items:center;gap:.25rem;">
            <span style="font-size:.78rem;font-weight:600;color:#2e7d32;margin-right:.3rem;">Rating:</span>
            @for($i = 1; $i <= 5; $i++)
                <span style="font-size:1.1rem;color:{{ $i <= $item->aspirasi->rating ? '#f59e0b' : '#d1d5db' }};">&#9733;</span>
            @endfor
            <span style="font-size:.78rem;color:#777;margin-left:.3rem;">({{ $item->aspirasi->rating }}/5)</span>
        </div>
        @endif
    </div>
    @endif
</div>
