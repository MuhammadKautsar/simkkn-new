<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Dosen;
use App\Models\Periode;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $nip = session()->get('nip');

        $kkns = Periode::where('status', '1')->orderBy('id', 'desc')->get();

        return view('dosen.beranda', compact('kkns', 'nip'));
    }

    public function data_kelompok()
    {
        $nip = session()->get('nip');

        return view('dosen.data-kelompok', compact('nip'));
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
