<?php
namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller {
    public function index() {
        $kategori = Kategori::orderBy('id_kategori')->get();
        return view('admin.kategori', compact('kategori'));
    }

    public function store(Request $request) {
        $request->validate(['ket_kategori' => 'required|string|max:30|unique:kategori,ket_kategori'], [
            'ket_kategori.required' => 'Nama kategori wajib diisi.',
            'ket_kategori.unique'   => 'Kategori sudah ada.',
        ]);
        $lastId = Kategori::max('id_kategori') ?? 0;
        Kategori::create(['id_kategori' => $lastId + 1, 'ket_kategori' => $request->ket_kategori]);
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id) {
        $kategori = Kategori::findOrFail($id);
        if ($kategori->id_kategori <= 2) return back()->with('error', 'Kategori default tidak bisa dihapus.');
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
