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
        // if (!Session::has('nim') || !Session::get('nim')) {
        //     // Redirect atau response sesuai kebutuhan
        //     return redirect()->route('sign-in')->with('error', 'Session tidak valid');
        // }

        // // Lanjutkan ke request selanjutnya jika session valid
        // return $next($request);

        $nim = $request->session()->get('nim'); // Ambil nim dari session
        $password = $request->session()->get('password'); // Ambil password dari session

        // $nim = $request->input('nim');
        // $password = $request->input('password');

        // dd(LoginModel::loginMahasiswa($nim, $password));

        if (!LoginModel::loginMahasiswa($nim, $password)) {
            // Jika tidak login sebagai mahasiswa, redirect ke halaman login
            return redirect()->route('sign-in')->with('error', 'Anda belum login sebagai mahasiswa.');
        }
        // dd(LoginModel::loginMahasiswa($nim, $password));


        return $next($request);
    }
}
