<form method="GET" action="{{ request()->url() }}" style="display:flex;align-items:center;gap:.5rem;">
    <select name="status" class="form-control" style="width:auto;font-size:.82rem;padding:.4rem .75rem;" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
        <option value="Proses"   {{ request('status') == 'Proses'   ? 'selected' : '' }}>Sedang Diproses</option>
        <option value="Selesai"  {{ request('status') == 'Selesai'  ? 'selected' : '' }}>Selesai</option>
    </select>
    @if(request('status'))
        <a href="{{ request()->url() }}" style="font-size:.8rem;color:#999;text-decoration:none;">Hapus filter</a>
    @endif
</form>
