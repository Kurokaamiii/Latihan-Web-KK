<?php
namespace App\Http\Controllers;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller {
    private function siswa() { return Session::get('siswa'); }

    public function dashboard() {
        $nis = $this->siswa()['nis'];
        $semua = InputAspirasi::with(['kategori', 'aspirasi'])->where('nis', $nis)->get();
        $stats = [
            'menunggu' => $semua->filter(fn($a) => $a->status === 'Menunggu')->count(),
            'proses'   => $semua->filter(fn($a) => $a->status === 'Proses')->count(),
            'selesai'  => $semua->filter(fn($a) => $a->status === 'Selesai')->count(),
        ];
        $terbaru = $semua->sortByDesc('created_at')->take(5);
        return view('siswa.dashboard', compact('stats', 'terbaru'));
    }

    public function buatAspirasi() {
        $kategori = Kategori::all();
        return view('siswa.buat', compact('kategori'));
    }

    public function simpanAspirasi(Request $request) {
        $request->validate([
            'id_kategori' => 'required|integer',
            'lokasi'      => 'required|string|max:50',
            'ket'         => 'required|string',
        ]);

        $lastId = InputAspirasi::max('id_pelaporan') ?? 0;
        InputAspirasi::create([
            'id_pelaporan' => $lastId + 1,
            'nis'          => $this->siswa()['nis'],
            'id_kategori'  => $request->id_kategori,
            'lokasi'       => $request->lokasi,
            'ket'          => $request->ket,
        ]);
        return redirect()->route('siswa.riwayat')->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function riwayat(Request $request) {
        $nis = $this->siswa()['nis'];
        $aspirasi = InputAspirasi::with(['kategori', 'aspirasi'])->where('nis', $nis)->orderBy('created_at', 'desc')->get();
        if ($request->filled('status')) {
            $aspirasi = $aspirasi->filter(fn($a) => $a->status === $request->status)->values();
        }
        return view('siswa.riwayat', compact('aspirasi'));
    }
}
