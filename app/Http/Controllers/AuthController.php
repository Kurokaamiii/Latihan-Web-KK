<?php
namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {
    public function showLogin() {
        if (Session::has('siswa')) return redirect()->route('siswa.dashboard');
        if (Session::has('admin')) return redirect()->route('admin.dashboard');
        return view('auth.login');
    }

    public function loginSiswa(Request $request) {
        $request->validate(['nis' => 'required|integer', 'password' => 'required']);
        $siswa = Siswa::where('nis', $request->nis)->where('password', $request->password)->first();
        if (!$siswa) return back()->withErrors(['login' => 'NIS atau password salah.'])->withInput();
        Session::put('siswa', ['nis' => $siswa->nis, 'username' => $siswa->username, 'kelas' => $siswa->kelas]);
        return redirect()->route('siswa.dashboard');
    }

    public function loginAdmin(Request $request) {
        $request->validate(['username' => 'required', 'password' => 'required']);
        $admin = Admin::where('username', $request->username)->where('password', $request->password)->first();
        if (!$admin) return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
        Session::put('admin', ['username' => $admin->username]);
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request) {
        Session::forget(['siswa', 'admin']);
        return redirect()->route('login');
    }
}
