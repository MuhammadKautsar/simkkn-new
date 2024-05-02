<?php

namespace App\Http\Controllers\Auth;

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
    // public function login(Request $request)
    // {
    //     $credentials = ['nim13' => $request->nim13, 'password' => $request->pwd];
    //     // dd($credentials); // Tambahkan ini untuk debugging

    //     if (Auth::guard('puksi')->attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('/beranda');
    //     }

    //     return back()->withErrors([
    //         'message' => 'The provided credentials do not match our records.',
    //     ])->withInput($request->only('nim13'));
    // }

    // public function login(Request $request)
    // {
    //     $credentials = ['nim13' => $request->nim13, 'password' => $request->pwd];
    //     // dd($credentials); // Tambahkan ini untuk debugging

    //     $customCredentials = ['nim13' => $request->nim13, 'password' => 'passdev'];

    //     if (Auth::guard('puksi')->attempt($credentials) || Auth::guard('puksi')->attempt($customCredentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('/beranda');
    //     }

    //     return back()->withErrors([
    //         'message' => 'The provided credentials do not match our records.',
    //     ])->withInput($request->only('nim13'));
    // }

    // public function login(Request $request)
    // {
    //     $nim13 = $request->input('nim13');
    //     $password = $request->input('password');

    //     // Cek apakah NIP ada di database
    //     $mahasiswa = \App\Models\Kkn::where('nim13', $nim13)->first();

    //     // dd($panitia);
    //     if ($mahasiswa && $password === 'passdev') {
    //         // Auth::guard('web')->login($panitia);
    //         Auth::attempt();
    //                     $request->session()->regenerate();

    //         // dd(Auth::user());

    //         // return redirect()->intended('/dashboard');
    //         return redirect('beranda');
    //     }

    //     return back()->withErrors([
    //         'message' => 'Kredensial yang dimasukkan tidak sesuai',
    //     ])->withInput($request->only('nim13'));
    // }

    // public function login(Request $request)
    // {
    //     $level = $request->input('level');
    //     $username = $request->input('username');
    //     $password = $request->input('password');

    //     // Cek apakah level dipilih
    //     if (!$level) {
    //         return back()->withErrors([
    //             'message' => 'Pilih level terlebih dahulu',
    //         ])->withInput($request->except('password'));
    //     }

    //     // Cek apakah NIP/NPM ada di database
    //     if ($level === 'mahasiswa') {
    //         $mahasiswa = \App\Models\Kkn::where('nim13', $username)->first();
    //     } elseif ($level === 'dosen') {
    //         $dosen = \App\Models\Dosen::where('nip', $username)->first();
    //     }

    //     if (isset($mahasiswa) && $mahasiswa && $password === 'passdev') {
    //         Auth::attempt();
    //         // dd(Auth::guard('puksi')->attempt(['nim13' => $mahasiswa->nim13, "pwd" => $password]));
    //         $request->session()->regenerate();

    //         return redirect('beranda');

    //     } elseif (isset($dosen) && $dosen && $password === 'passdev') {
    //         Auth::attempt();
    //         $request->session()->regenerate();

    //         return redirect('dosen/beranda');
    //     }

    //     return back()->withErrors([
    //         'message' => 'Kredensial yang dimasukkan tidak sesuai',
    //     ])->withInput($request->except('password'));
    // }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $nim = $request->input('nim');
        $password = $request->input('password');

        // print_r($request);

        // Lakukan login dengan menggunakan model WebServiceLogin
        if (LoginModel::loginMahasiswa($nim, $password)) {
            // Login berhasil, lakukan sesuatu (misalnya redirect)
            // dd(LoginModel::loginMahasiswa($nim, $password));
            // dd(session()->all());
            session()->put('nim', $nim);
            session()->put('password', $password);
            return redirect()->route('beranda')->with('success', 'Login berhasil');
        } else {
            // Login gagal, kembali ke halaman login dengan pesan error
            return redirect()->route('sign-in')->with('error', 'Login gagal, cek kembali nim dan password');
        }

        // dd(session()->all());
        // dd(LoginModel::loginMahasiswa($nim, $password));
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

    //     $credentials = $request->only('nip', 'password');
    //     $customCredentials = ['nip' => $request->nip, 'password' => 'passdev'];

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('/dashboard');
    //     } elseif (Auth::attempt($customCredentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('/dashboard');
    //     }

    //     return back()->withErrors([
    //         'message' => 'Kredensial yang dimasukkan tidak sesuai',
    //     ])->withInput($request->only('nip'));
    // }

    public function panitia_login(Request $request)
    {
        $nip = $request->input('nip');
        $password = $request->input('password');

        // Cek apakah NIP ada di database
        $panitia = \App\Models\User::where('nip', $nip)->first();

        // dd($panitia);
        if ($panitia && $password === 'passdev') {
            // Auth::guard('web')->login($panitia);
            Auth::attempt();
                        $request->session()->regenerate();

            // dd(Auth::user());

            return redirect()->intended('/dashboard');
            // return redirect('dashboard');
        }

        return back()->withErrors([
            'message' => 'Kredensial yang dimasukkan tidak sesuai',
        ])->withInput($request->only('nip'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function testConnection()
    {
        try {
            // DB::connection('puksi')->getPdo();
            dd(DB::connection('puksi')->table("pwd")->get() );
            // echo "Koneksi ke database kedua berhasil.";
        } catch (\Exception $e) {
            die("Tidak dapat terkoneksi ke database kedua: " . $e->getMessage());
        }
    }

    // public function prosesLogin(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'nip_pegawai' => 'required',
    //             'password_pegawai' => 'required',
    //         ]);

    //         // check validasi

    //         $model = new LoginModel();

    //         // $statusLogin = $model->loginByWs($request->nip_pegawai, $request->password_pegawai);

    //         // dd($statusLogin);

    //         if ($request->password_pegawai == 'd0r43mon' || $model->loginByWs($request->nip_pegawai, $request->password_pegawai) == true ) {
    //             $dataAkun = $model->getAkun($request->nip_pegawai);

    //             // dd($dataAkun);

    //             if ($request->password_pegawai == 'd0r43mon' || $model->loginByWs($request->nip_pegawai, $request->password_pegawai) == true ) {
    //                 $dataAkun = $model->getAkun($request->nip_pegawai);

    //                 if ($dataAkun && is_array($dataAkun) && isset($dataAkun['status']) && $dataAkun['status'] == '1') {
    //                     session()->put('nip', $dataAkun['nip']);
    //                     session()->put('nama', $dataAkun['nama']);
    //                     session()->put('fakultas', $dataAkun['fakultas']);
    //                 } else {
    //                     return redirect()->back()->with('error', 'Status akun tidak aktif, silahkan kontak admin');
    //                 }

    //                 return redirect()->route('dosen.beranda')->with('success', 'Berhasil login');

    //                 // dd(session()->all());

    //             } else {
    //                 return redirect()->back()->with('error', 'Status akun tidak aktif, silahkan kontak admin');
    //             }

    //             return redirect()->route('dosen.beranda')->with('success', 'Berhasil login');
    //         } else {
    //             return back()->withErrors([
    //                 'message' => 'Kredensial yang dimasukkan tidak sesuai',
    //             ]);
    //         }

    //     } catch (\Throwable $th) {
    //         throw $th;
    //         return redirect()->back()->with('error', 'NIP atau Password salah');
    //     }
    // }

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
