<?php

namespace App\Http\Controllers;

use App\Models\BerandaModel;
use App\Models\Kkn;
use App\Models\Dosen;
use App\Models\PanitiaModel;
use Illuminate\Http\Request;

class DosenController extends Controller
{
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

    public function data_kelompok($idKelompok = null)
    {
        // if (!Auth::user()->isDosen()) {
        //     return redirect()->route('home')->withErrors(['Anda tidak memiliki akses halaman ini.']);
        // }

        $nip = session()->get('nip');

        session(['id_kelompok' => $idKelompok]);

        $dosenModel = new Dosen();
        // $verifikatorModel = new Verifikator();
        $panitiaModel = new PanitiaModel();
        $berandaModel = new BerandaModel();

        $dataKelompok = $dosenModel->getKelompok($idKelompok);
        // $data['jenis_kkn'] = $verifikatorModel->getJenisKkn($dataKelompok->jenis_kkn);
        // $kodeKkn = $verifikatorModel->getJenisKkn($dataKelompok->jenis_kkn);
        // $data['jenis_kkn_kode'] = $verifikatorModel->getJenisKknKode($dataKelompok->jenis_kkn);
        $data['nama_geuchik'] = ucwords(strtolower($dataKelompok->nama_geuchik));
        $data['no_hp_geuchik'] = ucwords(strtolower($dataKelompok->no_hp_geuchik));
        $data['kd_kel'] = $dataKelompok->kd_kelompok;
        $data['id_kel'] = $dataKelompok->id;
        $data['proposal'] = $dataKelompok->proposal_kkn;
        // if ($kodeKkn->id == 10) {
        //     $data['penetapan'] = $dataKelompok->penetapan_kkn;
        // }
        $data['laporan'] = $dataKelompok->laporan_kkn;
        $lokasi = $dosenModel->getLokasi($dataKelompok->kd_kabkota);
        $data['lokasi_penempatan'] = ucwords(strtolower($dataKelompok->nama_desa)) . ", Kecamatan " . ucwords(strtolower($dataKelompok->nama_kecamatan)) . ", " . $lokasi;

        $dataPeriode = $dosenModel->getPeriode($dataKelompok->periode);
        $data['id_periode'] = $dataKelompok->periode;
        $data['nama_periode'] = "Periode " . preg_replace("/\((.*?)\)/", "", $dataPeriode->masa_periode);

        $data['status_dosen'] = $dosenModel->getStatusDosen($nip, $dataKelompok->periode);
        $generatorStatus = $panitiaModel->getStatusGenerator($data['id_periode']);
        if ($generatorStatus) {
            return "Anda belum memiliki akses halaman ini";
        } else {
            $data['mhs_kelompok'] = $dosenModel->getMhs($idKelompok);

            if (is_null($dataPeriode->batasan_waktu)) {
                $data = array_merge($data, $this->getDefaultWaktuData());
            } else {
                $dataWaktuMhs = $berandaModel->getBatasanWaktu($dataPeriode->batasan_waktu);
                $data = array_merge($data, $this->getWaktuData($dataWaktuMhs, date("d-m-Y")));
            }

            return view('dosen.data-kelompok', compact('data', 'nip'));
        }
    }

    private function getDefaultWaktuData()
    {
        return [
            'mulai_monev' => "-",
            'akhir_monev' => "-",
            'monev_ongoing' => false,
            'mulai_laporan_survey' => "-",
            'akhir_laporan_survey' => "-",
            'laporan_survey_ongoing' => false,
            'mulai_upload_nilai' => "-",
            'akhir_upload_nilai' => "-",
            'upload_nilai_ongoing' => false,
            'mulai_proposal' => "-",
            'akhir_proposal' => "-",
            'proposal_ongoing' => false,
            'mulai_logbook_1' => "-",
            'akhir_logbook_1' => "-",
            'logbook_1_ongoing' => false,
            'mulai_logbook_2' => "-",
            'akhir_logbook_2' => "-",
            'logbook_2_ongoing' => false,
            'mulai_logbook_3' => "-",
            'akhir_logbook_3' => "-",
            'logbook_3_ongoing' => false,
            'mulai_logbook_4' => "-",
            'akhir_logbook_4' => "-",
            'logbook_4_ongoing' => false,
            'mulai_laporan' => "-",
            'akhir_laporan' => "-",
            'laporan_ongoing' => false,
        ];
    }

    private function getWaktuData($dataWaktuMhs, $currentDate)
    {
        return [
            'mulai_proposal' => $this->checkNull($dataWaktuMhs->mulai_upload_proposal),
            'akhir_proposal' => $this->checkNull($dataWaktuMhs->akhir_upload_proposal),
            'proposal_ongoing' => $this->checkInRangeMhs($currentDate, $dataWaktuMhs->mulai_upload_proposal, $dataWaktuMhs->akhir_upload_proposal),
            'mulai_logbook_1' => $this->checkNull($dataWaktuMhs->mulai_logbook_1),
            'akhir_logbook_1' => $this->checkNull($dataWaktuMhs->akhir_logbook_1),
            'logbook_1_ongoing' => $this->checkInRangeMhs($currentDate, $dataWaktuMhs->mulai_logbook_1, $dataWaktuMhs->akhir_logbook_1),
            'mulai_logbook_2' => $this->checkNull($dataWaktuMhs->mulai_logbook_2),
            'akhir_logbook_2' => $this->checkNull($dataWaktuMhs->akhir_logbook_2),
            'logbook_2_ongoing' => $this->checkInRangeMhs($currentDate, $dataWaktuMhs->mulai_logbook_2, $dataWaktuMhs->akhir_logbook_2),
            'mulai_logbook_3' => $this->checkNull($dataWaktuMhs->mulai_logbook_3),
            'akhir_logbook_3' => $this->checkNull($dataWaktuMhs->akhir_logbook_3),
            'logbook_3_ongoing' => $this->checkInRangeMhs($currentDate, $dataWaktuMhs->mulai_logbook_3, $dataWaktuMhs->akhir_logbook_3),
            'mulai_logbook_4' => $this->checkNull($dataWaktuMhs->mulai_logbook_4),
            'akhir_logbook_4' => $this->checkNull($dataWaktuMhs->akhir_logbook_4),
            'logbook_4_ongoing' => $this->checkInRangeMhs($currentDate, $dataWaktuMhs->mulai_logbook_4, $dataWaktuMhs->akhir_logbook_4),
            'mulai_laporan' => $this->checkNull($dataWaktuMhs->mulai_laporan),
            'akhir_laporan' => $this->checkNull($dataWaktuMhs->akhir_laporan),
            'laporan_ongoing' => $this->checkInRangeMhs($currentDate, $dataWaktuMhs->mulai_laporan, $dataWaktuMhs->akhir_laporan),
            'mulai_laporan_survey' => $this->checkNull($dataWaktuMhs->mulai_laporan_survey),
            'akhir_laporan_survey' => $this->checkNull($dataWaktuMhs->akhir_laporan_survey),
            'laporan_survey_ongoing' => $this->checkInRange($currentDate, $dataWaktuMhs->mulai_laporan_survey, $dataWaktuMhs->akhir_laporan_survey),
            'mulai_monev' => $this->checkNull($dataWaktuMhs->mulai_monev),
            'akhir_monev' => $this->checkNull($dataWaktuMhs->akhir_monev),
            'monev_ongoing' => $this->checkInRange($currentDate, $dataWaktuMhs->mulai_monev, $dataWaktuMhs->akhir_monev),
            'mulai_upload_nilai' => $this->checkNull($dataWaktuMhs->mulai_upload_nilai),
            'akhir_upload_nilai' => $this->checkNull($dataWaktuMhs->akhir_upload_nilai),
            'upload_nilai_ongoing' => $this->checkInRange($currentDate, $dataWaktuMhs->mulai_upload_nilai, $dataWaktuMhs->akhir_upload_nilai),
        ];
    }

    private function checkNull($value)
    {
        return is_null($value) ? "-" : date('d-m-Y', strtotime($value));
    }

    private function checkInRangeMhs($currentDate, $startDate, $endDate)
    {
        return ($currentDate >= $startDate && $currentDate <= $endDate);
    }

    private function checkInRange($currentDate, $startDate, $endDate)
    {
        return ($currentDate >= $startDate && $currentDate <= $endDate);
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

    public function downloadPanduan($filename)
    {
        // Tentukan path file
        $path = storage_path('app/public/' . $filename);

        // Periksa apakah file ada
        if (!file_exists($path)) {
            abort(404);
        }

        // Kirim respons download
        return response()->download($path, $filename);
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
