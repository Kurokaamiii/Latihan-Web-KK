<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaAuth {
    public function handle(Request $request, Closure $next) {
        if (!Session::has('siswa')) return redirect()->route('login');
        return $next($request);
    }
}
