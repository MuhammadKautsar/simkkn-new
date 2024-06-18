<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // public function index()
    // {
    //     $nip = session()->get('nip');

    //     $kkns = Periode::where('status', '1')->orderBy('id', 'desc')->get();

    //     return view('dosen.daftar_kelompok_dosen', compact('kkns', 'nip'));
    // }

    public function index()
    {
        // $nip_dpl = session('username');
        $nip = session()->get('nip');

        $data['data_dosen'] = Dosen::getDosen2($nip);
        $data['daftar_kelompok'] = Dosen::getAllKelompok($nip);

        if (!empty($data['daftar_kelompok'])) {
            $data['data_korcam'] = Dosen::getDosen2($data['daftar_kelompok'][0]->nip_korcam);
        }

        $data['daftar_kelompok_korcam'] = Dosen::getAllKelompokKorcam($nip);

        return view('dosen.daftar_kelompok_dosen', compact('data', 'nip'));
    }

    public function data_kelompok()
    {
        $nip = session()->get('nip');

        return view('dosen.data-kelompok', compact('nip'));
    }

    public function profil_desa()
    {
        $nip = session()->get('nip');

        return view('dosen.unggah-profil-desa', compact('nip'));
    }

    public function survey_lapangan()
    {
        $nip = session()->get('nip');

        return view('dosen.unggah-survey', compact('nip'));
    }

    public function monev()
    {
        $nip = session()->get('nip');

        return view('dosen.unggah-monev', compact('nip'));
    }

    public function dokumen_kelompok()
    {
        $nip = session()->get('nip');

        return view('dosen.dokumen-kelompok', compact('nip'));
    }

    public function nilai()
    {
        $nip = session()->get('nip');

        return view('dosen.unggah-nilai', compact('nip'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kkn' => 'required|string|max:255',
        ]);

        // Simpan data KKN baru
        $kkn = new Kkn();
        $kkn->nama_kkn = $request->nama_kkn;
        $kkn->masa_kegiatan = $request->masa_kegiatan;
        $kkn->jenis_kkn = $request->jenis_kkn;
        $kkn->masa_pendaftaran = $request->masa_pendaftaran;
        $kkn->tahun_ajaran = $request->tahun_ajaran;
        $kkn->semester = $request->semester;
        $kkn->kode_kkn = $request->kode_kkn;
        $kkn->minimal_sks = $request->minimal_sks;
        $kkn->kuota_peserta = $request->kuota_peserta;
        $kkn->save();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'KKN baru berhasil ditambahkan.');
    }
}
