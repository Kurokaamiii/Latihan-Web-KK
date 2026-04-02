@extends('siswa.layout')
@section('title', 'Buat Aspirasi')
@section('content')
<div class="section-card">
    <div class="section-header">
        <h3>Buat Aspirasi Baru</h3>
        <p>Sampaikan aspirasi atau pengaduan Anda</p>
    </div>
    <div class="form-wrap">
        <form method="POST" action="{{ route('siswa.simpan') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Kategori *</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $kat)
                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->ket_kategori }}</option>
                    @endforeach
                </select>
                @error('id_kategori') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Lokasi *</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gedung A Lantai 2" value="{{ old('lokasi') }}" required>
                @error('lokasi') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Keterangan *</label>
                <textarea name="ket" class="form-control" rows="5" placeholder="Jelaskan detail aspirasi Anda..." required>{{ old('ket') }}</textarea>
                @error('ket') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn-submit">Kirim Aspirasi</button>
        </form>
    </div>
</div>
@endsection
