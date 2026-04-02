<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login',        [AuthController::class, 'showLogin'])->name('login');
Route::post('/login/siswa', [AuthController::class, 'loginSiswa'])->name('login.siswa');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/logout',      [AuthController::class, 'logout'])->name('logout');

Route::middleware('siswa.auth')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/buat',      [SiswaController::class, 'buatAspirasi'])->name('buat');
    Route::post('/buat',     [SiswaController::class, 'simpanAspirasi'])->name('simpan');
    Route::get('/riwayat',   [SiswaController::class, 'riwayat'])->name('riwayat');
});

Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',        [AdminController::class,   'dashboard'])->name('dashboard');
    Route::get('/aspirasi-masuk',   [AdminController::class,   'aspirasiMasuk'])->name('masuk');
    Route::get('/semua-aspirasi',   [AdminController::class,   'semuaAspirasi'])->name('semua');
    Route::post('/feedback/{id}',   [AdminController::class,   'updateFeedback'])->name('feedback');
    Route::get('/kategori',         [KategoriController::class,'index'])->name('kategori');
    Route::post('/kategori',        [KategoriController::class,'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class,'destroy'])->name('kategori.destroy');
});
