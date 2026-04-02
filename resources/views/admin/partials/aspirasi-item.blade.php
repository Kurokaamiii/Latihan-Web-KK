<div class="aspirasi-item">
    <div class="aspirasi-top">
        <div class="aspirasi-judul">{{ $item->ket }}</div>
        <span class="badge badge-{{ $item->status === 'Proses' ? 'proses' : ($item->status === 'Selesai' ? 'selesai' : 'menunggu') }}">
            {{ $item->status === 'Proses' ? 'Sedang Diproses' : $item->status }}
        </span>
    </div>
    <div class="siswa-info"><i class="fas fa-user"></i> NIS {{ $item->siswa->nis ?? '-' }} - {{ $item->siswa->username ?? '-' }}</div>
    <div class="aspirasi-meta">
        <span><i class="fas fa-calendar"></i> {{ $item->created_at->format('Y-m-d') }}</span>
        <span><i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}</span>
    </div>
    @if($item->kategori)
    <div><span class="kategori-badge">{{ $item->kategori->ket_kategori }}</span></div>
    @endif
    <div class="aspirasi-ket">{{ $item->ket }}</div>
    @if($item->aspirasi && $item->aspirasi->feedback)
    <div class="feedback-box" style="margin-bottom:.75rem;">
        <div class="fb-title"><i class="fas fa-comment"></i> Feedback:</div>
        <p>{{ $item->aspirasi->feedback }}</p>
        @if($item->aspirasi->rating)
        <div style="margin-top:.5rem;display:flex;align-items:center;gap:.3rem;">
            @for($i = 1; $i <= 5; $i++)
                <span style="font-size:1rem;color:{{ $i <= $item->aspirasi->rating ? '#f59e0b' : '#d1d5db' }};">&#9733;</span>
            @endfor
            <span style="font-size:.78rem;color:#777;margin-left:.3rem;">{{ $item->aspirasi->rating }}/5</span>
        </div>
        @endif
    </div>
    @endif
    <button class="btn-update-toggle" onclick="toggleUpdate({{ $item->id_pelaporan }})">Update Status & Feedback</button>
    <div class="update-panel" id="panel-{{ $item->id_pelaporan }}">
        <form method="POST" action="{{ route('admin.feedback', $item->id_pelaporan) }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required id="status-{{ $item->id_pelaporan }}" onchange="toggleRating({{ $item->id_pelaporan }}, this.value)">
                    <option value="Menunggu" {{ ($item->aspirasi?->status ?? 'Menunggu') === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Proses"   {{ ($item->aspirasi?->status) === 'Proses'   ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="Selesai"  {{ ($item->aspirasi?->status) === 'Selesai'  ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Feedback</label>
                <textarea name="feedback" class="form-control" rows="3" placeholder="Tulis balasan untuk siswa...">{{ $item->aspirasi?->feedback }}</textarea>
            </div>
            <div class="form-group" id="rating-group-{{ $item->id_pelaporan }}" style="display:{{ in_array($item->aspirasi?->status, ['Proses','Selesai']) ? 'block' : 'none' }};">
                <label class="form-label">Rating</label>
                <div id="stars-{{ $item->id_pelaporan }}">
                    @for($i = 1; $i <= 5; $i++)
                    <span class="star" data-val="{{ $i }}" onclick="setRating({{ $item->id_pelaporan }}, {{ $i }})" style="font-size:1.75rem;cursor:pointer;color:{{ $i <= ($item->aspirasi?->rating ?? 0) ? '#f59e0b' : '#d1d5db' }};">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-val-{{ $item->id_pelaporan }}" value="{{ $item->aspirasi?->rating }}">
            </div>
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>
</div>
