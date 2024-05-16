<?php

namespace App\Http\Controllers;

use App\Models\PanitiaModel;
use App\Models\Periode;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_panitia(Request $request)
    {
        $nip = $request->session()->get('nip');

        // $kkns = Periode::orderBy('id', 'desc')->paginate(10);
        $kkns = Periode::orderBy('id', 'desc')->where('status', '<>', 2)->get();

        return view('panitia.dashboard', compact('kkns', 'nip'));
    }

    // public function dashboard_panitia()
    // {
    //     // Membatasi akses menggunakan middleware atau fungsi lain sesuai kebutuhan
    //     // Misalnya menggunakan middleware 'auth' untuk memeriksa otentikasi
    //     // $this->middleware('auth');

    //     // $data['data_periode'] = PanitiaModel::get_all_periode(); // Panggil fungsi dari model
    //     // return view('dashboard', $data); // Kembalikan view dengan data yang diperlukan

    //     $panitiaModel = new PanitiaModel();
    //     $data['data_periode'] = $panitiaModel->get_all_periode();
    //     $data['jenis_kkn'] = $panitiaModel->get_jenis_kkn($data['data_periode']->jenis_kkn);
    //     return view('panitia.dashboard', $data);
    // }
}
