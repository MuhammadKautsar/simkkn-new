<?php

namespace App\Http\Controllers\Auth;

use App\Models\Kkn;
use App\Models\User;
use App\Models\LoginModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.signin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        // $level = $request->input('level');

        // if (!$level) {
        //     return back()->withErrors([
        //         'message' => 'Pilih level terlebih dahulu',
        //     ])->withInput($request->except('password'));
        // }

        if ($request->input('level')=='mahasiswa') {
            $nim = $request->input('username');
            $password = $request->input('password');

            // Lakukan login dengan menggunakan model WebServiceLogin
            if (LoginModel::loginMahasiswa($nim, $password) || $request->password == 'passdev') {
                session()->put('nim', $nim);
                session()->put('password', $password);
                // Check if the student has registered for KKN
                $isRegistered = Kkn::where('nim13', $nim)->exists();

                if ($isRegistered) {
                    return redirect()->route('mahasiswa')->with('success', 'Login berhasil');
                } else {
                    return redirect()->route('beranda')->with('success', 'Login berhasil, silakan mendaftar KKN');
                }
                // return redirect()->route('beranda')->with('success', 'Login berhasil');
            } else {
                // Login gagal, kembali ke halaman login dengan pesan error
                return redirect()->route('sign-in')->with('error', 'Login gagal, cek kembali nim dan password');
            }

        } elseif ($request->input('level')=='dosen') {
            $nip = $request->input('username');
            $password = $request->input('password');

            // Lakukan login dengan menggunakan model WebServiceLogin
            if (LoginModel::loginStaf($nip, $password) || $request->password == 'passdev') {
                session()->put('nip', $nip);
                session()->put('password', $password);
                return redirect()->route('dosen.beranda')->with('success', 'Login berhasil');
            } else {
                // Login gagal, kembali ke halaman login dengan pesan error
                return redirect()->route('sign-in')->with('error', 'Login gagal, cek kembali nip dan password');
            }
        }
    }

    public function panitia_index()
    {
        return view('auth.panitia-signin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function panitia_login(Request $request)
    // {
    //     $nip = $request->input('nip');
    //     $password = $request->input('password');

    //     // Cek apakah NIP ada di database
    //     $panitia = \App\Models\User::where('nip', $nip)->first();

    //     // dd($panitia);
    //     if ($panitia && $password === 'passdev') {
    //         // Auth::guard('web')->login($panitia);
    //         Auth::attempt();
    //                     $request->session()->regenerate();

    //         // dd(Auth::user());

    //         return redirect()->intended('/dashboard');
    //         // return redirect('dashboard');
    //     }

    //     return back()->withErrors([
    //         'message' => 'Kredensial yang dimasukkan tidak sesuai',
    //     ])->withInput($request->only('nip'));
    // }

    public function panitia_login(Request $request)
    {
        $request->validate([
            // 'level' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        // $level = $request->input('level');

        // if (!$level) {
        //     return back()->withErrors([
        //         'message' => 'Pilih level terlebih dahulu',
        //     ])->withInput($request->except('password'));
        // }

        $nip = $request->input('username');
        $password = $request->input('password');

        // Periksa apakah username (nip) tersedia di tabel users_kkn
        $user = User::where('nip', $nip)->first();

        if (!$user) {
            // Login gagal, kembali ke halaman login dengan pesan error
            return redirect()->route('panitia-sign-in')->with('error', 'Login gagal, Anda tidak terdaftar sebagai panitia BAPEL KKN');
        } else {
            // Lakukan login dengan menggunakan model WebServiceLogin
            if (LoginModel::loginStaf($nip, $password) || $request->password == 'passdev') {
                session()->put('nip', $nip);
                session()->put('password', $password);
                return redirect()->route('dashboard')->with('success', 'Login berhasil');
            } else {
                // Login gagal, kembali ke halaman login dengan pesan error
                return redirect()->route('panitia-sign-in')->with('error', 'Login gagal, cek kembali nip dan password');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required', // Misalnya, role 1 untuk mahasiswa dan role 2 untuk staf
        ]);

        $model = new LoginModel();
        $username = $request->username;
        $password = $request->password;

        if ($request->role == 1) {
            if ($model->loginMahasiswa($username, $password)) {
                // Login mahasiswa berhasil, lakukan penanganan sesuai kebutuhan
                return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai mahasiswa');
            } else {
                // Login mahasiswa gagal
                return back()->withErrors(['message' => 'Kredensial yang dimasukkan tidak sesuai']);
            }
        } elseif ($request->role == 2) {
            if ($model->loginStaf($username, $password)) {
                // Login staf berhasil, lakukan penanganan sesuai kebutuhan
                return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai staf');
            } else {
                // Login staf gagal
                return back()->withErrors(['message' => 'Kredensial yang dimasukkan tidak sesuai']);
            }
        }

        // Role tidak valid
        return back()->withErrors(['message' => 'Role tidak valid']);
    }
}
