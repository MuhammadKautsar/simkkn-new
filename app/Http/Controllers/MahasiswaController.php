<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Periode;
use App\Models\DaftarModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    public function index()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();
        return view('mahasiswa.kegiatan-kkn', compact('mahasiswa', 'data'));
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
        return redirect()->route('beranda')->with('success', 'Berhasil daftar KKN.');
    }

    public function cetakPdf($nim13, $periode)
    {
        // Ambil data dari model
        $data = Kkn::getDataMhsCetak($nim13, $periode);
        $date = now()->format('d M Y');

        // Generate PDF
        $pdf = Pdf::loadView('mahasiswa.print', compact('data', 'date'));

        // Download PDF
        // return $pdf->download($nim13 . '.pdf');
        return $pdf->stream($data->nim13 . '.pdf');
    }

    private function fotoKRS($nim13)
    {
        // Implementasi fungsi fotoKRS
    }
}
