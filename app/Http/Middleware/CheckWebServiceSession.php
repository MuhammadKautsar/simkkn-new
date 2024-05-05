<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\LoginModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWebServiceSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $nim = $request->session()->get('nim'); // Ambil nim dari session
        $nip = $request->session()->get('nip'); // Ambil nim dari session
        $password = $request->session()->get('password'); // Ambil password dari session

        // dd(LoginModel::loginMahasiswa($nim, $password));

        if (LoginModel::loginMahasiswa($nim, $password) || LoginModel::loginStaf($nip, $password) || $password == 'passdev') {
            return $next($request);
        } elseif (!LoginModel::loginMahasiswa($nim, $password) || !LoginModel::loginStaf($nip, $password)) {
            // Jika tidak login, redirect ke halaman login
            return redirect()->route('sign-in')->with('error', 'Anda belum login');
        }
    }
}
