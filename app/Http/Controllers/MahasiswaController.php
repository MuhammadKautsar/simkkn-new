<?php

namespace App\Http\Controllers;

use App\Models\BerandaModel;
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
        // $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();

        $berandaModel = new BerandaModel();

        // Data Mahasiswa
        $dataMhs = $berandaModel->getMhs($nim);
        // $data['sks_punya'] = $daftar->getSks($username);

        if (!$dataMhs) {
            return redirect('sign-in');
        }

        $data['nama'] = $dataMhs['nama_mhs'];
        $data['nim'] = $dataMhs['nim13'];
        $data['fakultas'] = $dataMhs['nama_fakultas'];
        $data['jurusan'] = $dataMhs['nama_prodi'];
        $data['agama'] = $dataMhs['agama'];
        $data['jenis_kelamin'] = $dataMhs['jenis_kelamin'];
        $data['no_hp'] = $dataMhs['no_telp_mhs'];
        $data['kelompok'] = $dataMhs['kelompok'];
        $data['berkas_kkn'] = $dataMhs['berkas_kkn'];

        $data['riwayat_penyakit'] = $dataMhs['penyakit'] ? $dataMhs['penyakit'] : 'Tidak Ada';

        $data['periode'] = $dataMhs['periode'];

        // $data['format_logbook'] = $berandaModel->getFormatLogbook();

        //data periode
        $dataPeriode = $berandaModel->getPeriode($dataMhs['periode']);
        $data_periode['id_periode'] = $dataMhs['periode'];
        // $data['kode_kkn'] = $berandaModel->getJenisKknPeriode($data['id_periode']);
        $data_periode['nama_periode'] = preg_replace("/\((.*?)\)/", "", $dataPeriode->masa_periode);

        // if ($dataPeriode->lokasi == 0) {
        //     $data['lokasi_kkn'] = "-";
        // } else {
        //     $data['lokasi_kkn'] = $berandaModel->getLokasi($dataPeriode->lokasi);
        // }

        if ($dataPeriode->jenis_kkn == 0) {
            $data_periode['jenis_kkn'] = "-";
        } else {
            $data_periode['jenis_kkn'] = $berandaModel->getJenisKkn($dataPeriode->jenis_kkn);
        }

        preg_match('/\((.*?)\)/', $dataPeriode->masa_periode, $masaPeriode);
        $data_periode['masa_periode'] = $masaPeriode[1];

        return view('mahasiswa.kegiatan-kkn', compact('mahasiswa', 'data', 'data_periode'));
    }

    public function kelompok()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        // $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();

        $beranda = new BerandaModel();
        // $daftar = new Daftar();

        $dataMhs = $beranda->getMhs($nim);

        $dataPeriode = $beranda->getPeriode($dataMhs['periode']);


        $data_periode['id_periode'] = $dataMhs['periode'];
        // $data['kode_kkn'] = $berandaModel->getJenisKknPeriode($data['id_periode']);
        $data_periode['nama_periode'] = preg_replace("/\((.*?)\)/", "", $dataPeriode->masa_periode);

        if ($dataPeriode->jenis_kkn == 0) {
            $data_periode['jenis_kkn'] = "-";
        } else {
            $data_periode['jenis_kkn'] = $beranda->getJenisKkn($dataPeriode->jenis_kkn);
        }

        if (!$dataMhs) {
            return redirect('login_kkn');
        }


        $data['id_kelompok'] = $dataMhs['kelompok'];
        if (empty($dataMhs['kelompok']) || $beranda->getStatusGenerator($data_periode['id_periode'])) {
            $data['status'] = '-';
            $data['nama_geuchik'] = '-';
            $data['no_hp_geuchik'] = '-';
            $data['kode_kel'] = '-';
            $data['nama_dpl'] = '-';
            $data['desa_penempatan'] = '-';
            $data['mhs_kelompok'] = '0';
        } else {
            $dataKelompok = (array) $beranda->getKelompok($dataMhs['kelompok']);
            $data['status'] = $beranda->getKetuaKelompok($dataMhs['kelompok'], $dataMhs['nim13']);
            $data['nama_geuchik'] = ucwords(strtolower($dataKelompok['nama_geuchik']));
            $data['no_hp_geuchik'] = $dataKelompok['no_hp_geuchik'];
            $data['kode_kel'] = $dataKelompok['kd_kelompok'];
            $namaKabupaten = ucwords(strtolower($beranda->getRegencies($dataKelompok['kd_kabkota'])));
            $data['desa_penempatan'] = ucwords(strtolower($dataKelompok['nama_desa'])) . ", " . ucwords(strtolower($dataKelompok['nama_kecamatan'])) . ", " . $namaKabupaten;
            $data['nama_dpl'] = ucwords(strtolower($beranda->getDpl($dataKelompok['nip_dpl'], $dataKelompok['periode'])));
            $data['mhs_kelompok'] = $beranda->getMhsKel($dataMhs['kelompok']);
        }

        return view('mahasiswa.kelompok', compact('mahasiswa', 'data', 'data_periode'));
    }

    public function upload_berkas()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();

        return view('mahasiswa.upload-berkas', compact('mahasiswa', 'data'));
    }

    public function upload_proposal()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();
        return view('mahasiswa.upload-proposal', compact('mahasiswa', 'data'));
    }

    public function upload_logbook()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();
        return view('mahasiswa.upload-logbook', compact('mahasiswa', 'data'));
    }

    public function upload_laporan()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();
        return view('mahasiswa.upload-laporan', compact('mahasiswa', 'data'));
    }

    public function nilai_akhir()
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();
        return view('mahasiswa.nilai-akhir', compact('mahasiswa', 'data'));
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
