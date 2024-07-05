<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kkn;
use App\Models\Periode;
use App\Models\DaftarModel;
use App\Models\BerandaModel;
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
        $data['id_periode'] = $dataMhs['periode'];
        // $data['kode_kkn'] = $berandaModel->getJenisKknPeriode($data['id_periode']);
        $data['nama_periode'] = preg_replace("/\((.*?)\)/", "", $dataPeriode->masa_periode);

        // if ($dataPeriode->lokasi == 0) {
        //     $data['lokasi_kkn'] = "-";
        // } else {
        //     $data['lokasi_kkn'] = $berandaModel->getLokasi($dataPeriode->lokasi);
        // }

        if ($dataPeriode->jenis_kkn == 0) {
            $data['jenis_kkn'] = "-";
        } else {
            $data['jenis_kkn'] = $berandaModel->getJenisKkn($dataPeriode->jenis_kkn);
        }

        preg_match('/\((.*?)\)/', $dataPeriode->masa_periode, $masaPeriode);
        $data['masa_periode'] = $masaPeriode[1];

        //data kelompok
        $data['id_kelompok'] = $dataMhs['kelompok'];
        if (empty($dataMhs['kelompok']) || $berandaModel->getStatusGenerator($data['id_periode'])) {
            $data['status'] = '-';
            $data['nama_geuchik'] = '-';
            $data['no_hp_geuchik'] = '-';
            $data['kode_kel'] = '-';
            $data['nama_dpl'] = '-';
            $data['desa_penempatan'] = '-';
            $data['mhs_kelompok'] = '0';
        } else {
            $dataKelompok = (array) $berandaModel->getKelompok($dataMhs['kelompok']);
            $data['status'] = $berandaModel->getKetuaKelompok($dataMhs['kelompok'], $dataMhs['nim13']);
            $data['nama_geuchik'] = ucwords(strtolower($dataKelompok['nama_geuchik']));
            $data['no_hp_geuchik'] = $dataKelompok['no_hp_geuchik'];
            $data['kode_kel'] = $dataKelompok['kd_kelompok'];
            $namaKabupaten = ucwords(strtolower($berandaModel->getRegencies($dataKelompok['kd_kabkota'])));
            $data['desa_penempatan'] = ucwords(strtolower($dataKelompok['nama_desa'])) . ", " . ucwords(strtolower($dataKelompok['nama_kecamatan'])) . ", " . $namaKabupaten;
            $data['nama_dpl'] = ucwords(strtolower($berandaModel->getDpl($dataKelompok['nip_dpl'], $dataKelompok['periode'])));
            $data['mhs_kelompok'] = $berandaModel->getMhsKel($dataMhs['kelompok']);
        }

        //data range waktu
        if (is_null($dataPeriode->batasan_waktu)) {
            $data['mulai_proposal'] = "-";
            $data['akhir_proposal'] = "-";
            $data['proposal_ongoing'] = false;
            $data['penetapan_ongoing'] = false;
            $data['mulai_logbook_1'] = "-";
            $data['akhir_logbook_1'] = "-";
            $data['logbook_1_ongoing'] = false;
            $data['mulai_logbook_2'] = "-";
            $data['akhir_logbook_2'] = "-";
            $data['logbook_2_ongoing'] = false;
            $data['mulai_logbook_3'] = "-";
            $data['akhir_logbook_3'] = "-";
            $data['logbook_3_ongoing'] = false;
            $data['mulai_logbook_4'] = "-";
            $data['akhir_logbook_4'] = "-";
            $data['logbook_4_ongoing'] = false;
            $data['mulai_laporan'] = "-";
            $data['akhir_laporan'] = "-";
            $data['laporan_ongoing'] = false;
        } else {
            $dataWaktu = $berandaModel->getBatasanWaktu($dataPeriode->batasan_waktu);
            $data['mulai_proposal'] = $this->checkNull($dataWaktu->mulai_upload_proposal);
            $data['akhir_proposal'] = $this->checkNull($dataWaktu->akhir_upload_proposal);
            $data['proposal_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_proposal'], $data['akhir_proposal']);
            $data['penetapan_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_proposal'], $data['akhir_proposal']);
            $data['mulai_logbook_1'] = $this->checkNull($dataWaktu->mulai_logbook_1);
            $data['akhir_logbook_1'] = $this->checkNull($dataWaktu->akhir_logbook_1);
            $data['logbook_1_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_logbook_1'], $data['akhir_logbook_1']);
            $data['mulai_logbook_2'] = $this->checkNull($dataWaktu->mulai_logbook_2);
            $data['akhir_logbook_2'] = $this->checkNull($dataWaktu->akhir_logbook_2);
            $data['logbook_2_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_logbook_2'], $data['akhir_logbook_2']);
            $data['mulai_logbook_3'] = $this->checkNull($dataWaktu->mulai_logbook_3);
            $data['akhir_logbook_3'] = $this->checkNull($dataWaktu->akhir_logbook_3);
            $data['logbook_3_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_logbook_3'], $data['akhir_logbook_3']);
            $data['mulai_logbook_4'] = $this->checkNull($dataWaktu->mulai_logbook_4);
            $data['akhir_logbook_4'] = $this->checkNull($dataWaktu->akhir_logbook_4);
            $data['logbook_4_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_logbook_4'], $data['akhir_logbook_4']);
            $data['mulai_laporan'] = $this->checkNull($dataWaktu->mulai_laporan);
            $data['akhir_laporan'] = $this->checkNull($dataWaktu->akhir_laporan);
            $data['laporan_ongoing'] = $this->checkInRange(Carbon::now()->format('d-m-Y'), $data['mulai_laporan'], $data['akhir_laporan']);
        }

        $data['nilai_mhs'] = $berandaModel->getNilaiMhs($data['id_periode'], $dataMhs['nim13']);
        $data['status_nilai_mhs'] = $dataPeriode->status_nilai_mhs;

        return view('mahasiswa.kegiatan-kkn', compact('mahasiswa', 'data'));
    }

    private function checkNull($value)
    {
        if (is_null($value)) {
            return "-";
        } else {
            return Carbon::parse($value)->format('d-m-Y');
        }
    }

    private function checkInRange($dateFromUser, $startDate, $endDate)
    {
        if ($startDate === "-") {
            return false;
        } else {
            // Convert to timestamp
            $startTs = Carbon::createFromFormat('d-m-Y', $startDate)->timestamp;
            $endTs = Carbon::createFromFormat('d-m-Y', $endDate)->timestamp;
            $userTs = Carbon::createFromFormat('d-m-Y', $dateFromUser)->timestamp;

            // Check that user date is between start & end
            return (($userTs >= $startTs) && ($userTs <= $endTs));
        }
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
