<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kkn;
use App\Models\Dosen;
use App\Models\DaftarModel;
use App\Models\BerandaModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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

        $datalb = [
            'logbook1' => BerandaModel::getLogbook($nim, 1),
            'logbook2' => BerandaModel::getLogbook($nim, 2),
            'logbook3' => BerandaModel::getLogbook($nim, 3),
            'logbook4' => BerandaModel::getLogbook($nim, 4),
            'link1' => BerandaModel::getLinks($nim, 1),
            'link2' => BerandaModel::getLinks($nim, 2),
            'link3' => BerandaModel::getLinks($nim, 3),
            'link4' => BerandaModel::getLinks($nim, 4),
        ];

        // $data['format_logbook'] = $berandaModel->getFormatLogbook();

        //data periode
        $dataPeriode = $berandaModel->getPeriode($dataMhs['periode']);
        $data['id_periode'] = $dataMhs['periode'];
        // $data['kode_kkn'] = $berandaModel->getJenisKknPeriode($data['id_periode']);

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

        if ($dataPeriode->nama_kkn == NULL) {
            $data['nama_periode'] = preg_replace("/\((.*?)\)/", "", $dataPeriode->masa_periode);
            preg_match('/\((.*?)\)/', $dataPeriode->masa_periode, $masaPeriode);
            $data['masa_periode'] = $masaPeriode[1];
        } else {
            $data['nama_kkn'] = $dataPeriode->nama_kkn;
            $data['masa_periode'] = $dataPeriode->masa_periode;
        }

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

            $data['profil_desa'] = '-';
            $data['laporan_survey'] = '-';
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

            $data['profil_desa'] = $dataKelompok['profil_desa'];
            $data['laporan_survey'] = $dataKelompok['laporan_survey'];
            $data['proposal_kkn'] = $dataKelompok['proposal_kkn'];
            $data['laporan_kkn'] = $dataKelompok['laporan_kkn'];
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
            $data['proposal_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_proposal'], $data['akhir_proposal']);
            $data['penetapan_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_proposal'], $data['akhir_proposal']);
            $data['mulai_logbook_1'] = $this->checkNull($dataWaktu->mulai_logbook_1);
            $data['akhir_logbook_1'] = $this->checkNull($dataWaktu->akhir_logbook_1);
            $data['logbook_1_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_logbook_1'], $data['akhir_logbook_1']);
            $data['mulai_logbook_2'] = $this->checkNull($dataWaktu->mulai_logbook_2);
            $data['akhir_logbook_2'] = $this->checkNull($dataWaktu->akhir_logbook_2);
            $data['logbook_2_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_logbook_2'], $data['akhir_logbook_2']);
            $data['mulai_logbook_3'] = $this->checkNull($dataWaktu->mulai_logbook_3);
            $data['akhir_logbook_3'] = $this->checkNull($dataWaktu->akhir_logbook_3);
            $data['logbook_3_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_logbook_3'], $data['akhir_logbook_3']);
            $data['mulai_logbook_4'] = $this->checkNull($dataWaktu->mulai_logbook_4);
            $data['akhir_logbook_4'] = $this->checkNull($dataWaktu->akhir_logbook_4);
            $data['logbook_4_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_logbook_4'], $data['akhir_logbook_4']);
            $data['mulai_laporan'] = $this->checkNull($dataWaktu->mulai_laporan);
            $data['akhir_laporan'] = $this->checkNull($dataWaktu->akhir_laporan);
            $data['laporan_ongoing'] = $this->checkInRange(date('Y-m-d'), $data['mulai_laporan'], $data['akhir_laporan']);
        }

        $data['nilai_mhs'] = $berandaModel->getNilaiMhs($data['id_periode'], $dataMhs['nim13']);
        $data['status_nilai_mhs'] = $dataPeriode->status_nilai_mhs;

        return view('mahasiswa.kegiatan-kkn', compact('mahasiswa', 'data', 'datalb'));
    }

    private function checkNull($value)
    {
        return is_null($value) ? "-" : date('d-m-Y', strtotime($value));
    }

    private function checkInRange($currentDate, $startDate, $endDate)
    {
        return ($currentDate >= $startDate && $currentDate <= $endDate);
    }

    public function uploadBerkas(Request $request)
    {
        $id_periode = $request->input('id_periode');
        $nim = $request->input('nim');
        $kode_kel = $request->input('kode_kel');
        $id_kelompok = $request->input('id_kelompok');
        $urutan_logbook = "logbook_" . $request->input('urutan_logbook');
        $urutan_link = "youtube_" . $request->input('urutan_logbook');
        $link = $request->input('link');
        $response = ['status' => false, 'pesan' => ''];

        $dokumenTypes = ['berkas_kkn', 'proposal_kkn', 'laporan_kkn', 'logbook'];
        foreach ($dokumenTypes as $type) {
            if ($request->hasFile($type) && $request->file($type)->isValid()) {
                $file = $request->file($type);

                if ($type == 'berkas_kkn') {
                    $fileName = $type . '_' . $nim . '_' . $id_periode . '.' . $file->getClientOriginalExtension();
                } elseif ($type == 'logbook') {
                    $fileName = $type . '_' . $nim . '_' . $request->input('urutan_logbook') . '_' . $id_periode . '.' . $file->getClientOriginalExtension();
                } else {
                    $fileName = $type . '_' . $kode_kel . '_' . $id_periode . '.' . $file->getClientOriginalExtension();
                }
                // Simpan file ke storage
                $path = $file->storeAs('uploads/' . $type, $fileName);

                if ($path) {
                    // Update atau simpan informasi file ke database
                    if ($type == 'laporan_kkn') {
                        $data_upload = [$type => $fileName, 'user_uploadlaporan' => $nim];
                    } elseif ($type == 'logbook') {
                        $data_logbook = [$urutan_logbook => $fileName, $urutan_link => $link];
                    } else {
                        $data_upload = [$type => $fileName];
                    }

                    if ($type == 'berkas_kkn') {
                        $result = BerandaModel::insertBerkas($data_upload, $nim, $id_periode);
                    } elseif ($type == 'logbook') {
                        $result = BerandaModel::insertLogbook($urutan_logbook, $data_logbook, $nim);
                    } else {
                        $result = BerandaModel::insertDokumen($data_upload, $id_kelompok);
                    }

                    if ($result) {
                        $response['status'] = true;
                        $response['pesan'] = 'Dokumen berhasil diupload';
                    } else {
                        $response['pesan'] = 'Gagal menyimpan data ' . $type;
                        break;
                    }
                } else {
                    $response['pesan'] = 'Gagal mengupload ' . $type;
                    break;
                }
            }
        }

        return response()->json($response);
    }

    public function downloadBerkas($nim, $jenis_doc, $id_periode)
    {
        // Tentukan path file berdasarkan jenis_doc, nim dan periode
        $filePath = "uploads/{$jenis_doc}/{$jenis_doc}_{$nim}_{$id_periode}.pdf";

        // Cek apakah file ada
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Download file
        return Storage::download($filePath);
    }

    public function downloadDokumen($kode_kel, $jenis_doc, $id_periode)
    {
        // Tentukan path file berdasarkan jenis_doc, kode_kel dan periode
        $filePath = "uploads/{$jenis_doc}/{$jenis_doc}_{$kode_kel}_{$id_periode}.pdf";

        // Cek apakah file ada
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Download file
        return Storage::download($filePath);
    }

    public function downloadLogbook($nim, $jenis_doc, $urutan_logbook, $id_periode)
    {
        $filePath = "uploads/{$jenis_doc}/{$jenis_doc}_{$nim}_{$urutan_logbook}_{$id_periode}.pdf";

        // Cek apakah file ada
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Download file
        return Storage::download($filePath);
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
