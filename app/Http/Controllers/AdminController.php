<?php
namespace App\Http\Controllers;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function dashboard(Request $request) {
        $semua = InputAspirasi::with(['siswa', 'kategori', 'aspirasi'])->get();
        $stats = [
            'menunggu' => $semua->filter(fn($a) => $a->status === 'Menunggu')->count(),
            'proses'   => $semua->filter(fn($a) => $a->status === 'Proses')->count(),
            'selesai'  => $semua->filter(fn($a) => $a->status === 'Selesai')->count(),
            'total'    => $semua->count(),
        ];
        $aspirasi = $semua->sortBy(fn($a) => match($a->status) {
            'Menunggu' => 0, 'Proses' => 1, 'Selesai' => 2, default => 3
        })->values();
        if ($request->filled('status')) {
            $aspirasi = $aspirasi->filter(fn($a) => $a->status === $request->status)->values();
        }
        return view('admin.dashboard', compact('stats', 'aspirasi'));
    }

    public function aspirasiMasuk() {
        $aspirasi = InputAspirasi::with(['siswa', 'kategori', 'aspirasi'])->get()
            ->filter(fn($a) => $a->status === 'Menunggu')->values();
        return view('admin.aspirasi-masuk', compact('aspirasi'));
    }

    public function semuaAspirasi(Request $request) {
        $aspirasi = InputAspirasi::with(['siswa', 'kategori', 'aspirasi'])->get();
        if ($request->filled('status')) {
            $aspirasi = $aspirasi->filter(fn($a) => $a->status === $request->status)->values();
        }
        return view('admin.semua-aspirasi', compact('aspirasi'));
    }

    public function updateFeedback(Request $request, $id) {
        $request->validate([
            'status'   => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string',
            'rating'   => 'nullable|integer|min:1|max:5',
        ]);
        $input = InputAspirasi::findOrFail($id);
        $rating = in_array($request->status, ['Proses', 'Selesai']) ? $request->rating : null;
        $lastId = Aspirasi::max('id_aspirasi') ?? 0;
        Aspirasi::updateOrCreate(
            ['id_pelaporan' => $input->id_pelaporan],
            ['id_aspirasi' => $lastId + 1, 'status' => $request->status, 'id_kategori' => $input->id_kategori, 'feedback' => $request->feedback, 'rating' => $rating]
        );
        return back()->with('success', 'Berhasil diperbarui!');
    }
}
