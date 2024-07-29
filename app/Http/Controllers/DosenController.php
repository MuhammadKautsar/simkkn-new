<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Dosen;
use App\Models\BerandaModel;
use App\Models\PanitiaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
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
        $nip = session()->get('nip');

        session(['id_kelompok' => $idKelompok]);

        $dosenModel = new Dosen();
        // $verifikatorModel = new Verifikator();
        $panitiaModel = new PanitiaModel();
        $berandaModel = new BerandaModel();

        $dataKelompok = Dosen::getKelompok($idKelompok);
        $data['jenis_kkn'] = $dosenModel->getJenisKkn($dataKelompok->jenis_kkn);
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

            $data['nilai_kelompok'] = $dosenModel->getMhs3($idKelompok);

            if (is_null($dataPeriode->batasan_waktu)) {
                $data = array_merge($data, $this->getDefaultWaktuData());
            } else {
                $dataWaktuMhs = $berandaModel->getBatasanWaktu($dataPeriode->batasan_waktu);
                $data = array_merge($data, $this->getWaktuData($dataWaktuMhs, date("Y-m-d")));
            }

            return view('dosen.data-kelompok', compact('dataKelompok', 'data', 'nip'));
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

    public function uploadDokumen(Request $request)
    {
        $jenis_doc = $request->input('jenis-doc');
        $id_kelompok = $request->input('id_kelompok');

        if ($request->hasFile('dokumen_file') && $request->file('dokumen_file')->isValid()) {
            $file = $request->file('dokumen_file');
            $filename = $jenis_doc . "_" . $id_kelompok . "." . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads/' . $jenis_doc, $filename);

            if ($path) {
                $result = Dosen::insertDokumen($jenis_doc, $filename, $id_kelompok);

                if($result){
                    $response = [
                        'status' => true,
                        'id_kelompok'=> $id_kelompok,
                        'jenis_doc' => $jenis_doc,
                        'pesan' => 'Dokumen berhasil ditambahkan'
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'id_kelompok'=> $id_kelompok,
                        'jenis_doc' => $jenis_doc,
                        'pesan' => 'Terjadi kesalahan'
                    ];
                }
            } else {
                $response = [
                    'status' => false,
                    'id_kelompok'=> $id_kelompok,
                    'jenis_doc' => $jenis_doc,
                    'pesan' => 'Gagal mengunggah dokumen'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'id_kelompok'=> $id_kelompok,
                'jenis_doc' => $jenis_doc,
                'pesan' => 'Terjadi kesalahan'
            ];
        }

        return response()->json($response);
    }

    public function downloadDokumen($id_kelompok, $jenis_doc)
    {
        // Tentukan path file berdasarkan jenis_doc dan id_kelompok
        $filePath = "uploads/{$jenis_doc}/{$jenis_doc}_{$id_kelompok}.pdf";

        // Cek apakah file ada
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Download file
        return Storage::download($filePath);
    }

    public function downloadNilai($kd_kelompok, $jenis_doc, $id_periode)
    {
        $filePath = "uploads/{$jenis_doc}/Nilai_{$kd_kelompok}_{$id_periode}.pdf";

        // Cek apakah file ada
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Download file
        return Storage::download($filePath);
    }

    public function uploadNilai(Request $request)
    {
            if (($request->file('nilai') && $request->file('nilai')->isValid())) {
                if (($request->file('nilai_geuchik') && $request->file('nilai_geuchik')->isValid())) {
                    $data_batas_waktu = Dosen::cekBatasWaktu($request->id_periode);
                    $current_date = now()->format('Y-m-d');
                    if (!$this->checkInRange($current_date, $data_batas_waktu->mulai_upload_nilai, $data_batas_waktu->akhir_upload_nilai)) {
                        return response()->json([
                            'status' => false,
                            'pesan' => "Masa Upload Nilai Telah Berakhir",
                        ]);
                    } else {
                        $nim = $request->input('nim');
                        $asal = $request->input('asal');
                        $nilai_geuchik = $request->input('nilai_geuchik');
                        $nilai_sementara = $request->input('nilai_sementara');
                        $nilai_akhir = $request->input('nilai_akhir');
                        $id_kelompok = $request->input('id_kelompok');
                        $kd_kelompok = $request->input('kd_kelompok');
                        $id_periode = $request->input('id_periode');

                        $upload_data = null;
                        $upload_data_geuchik = null;

                        // if ($jenis_user !== 'verifikator') {
                            $upload_data = $request->file('nilai')->storeAs(
                                'uploads/bukti_nilai',
                                "Nilai_{$kd_kelompok}_{$id_periode}.pdf"
                            );

                            $upload_data_geuchik = $request->file('nilai_geuchik')->storeAs(
                                'uploads/bukti_nilai',
                                "Nilai_Geuchik_{$kd_kelompok}_{$id_periode}.pdf"
                            );
                        // }

                        $result = true;
                        foreach ($nim as $index => $n) {
                            $nilai_huruf = null;
                            // if ($jenis_user == 'verifikator' || $jenis_kkn !== 10) {
                                $nilai_huruf = $this->convertToNilaiHuruf($nilai_akhir[$index]);
                            // }

                            $data_mhs = Dosen::getDataMhs($n, $id_periode);
                            $data_kelompok = Dosen::getKelompok($data_mhs->kelompok);

                            if ($asal[$index] == 1) {
                                $data_nilai = [
                                    'jenis_kkn' => $data_kelompok->jenis_kkn,
                                    'kd_kelompok' => $data_kelompok->kd_kelompok,
                                    'periode' => $data_mhs->periode,
                                    'nim13' => $data_mhs->nim13,
                                    'nilai' => $nilai_huruf,
                                    'nilai_geuchik' => $nilai_geuchik[$index],
                                    'id_user' => session('nip'),
                                    'nilai_des' => $nilai_akhir[$index] ?? null,
                                    // 'nilai_verified' => $nilai_akhir[$index] ?? null,
                                    'nilai_dosen' => null,
                                ];
                                $result = Dosen::updateData('nim13', $data_mhs->nim13, 'periode', $data_mhs->periode, 'nilai_kkn', $data_nilai);
                            } elseif ($asal[$index] == 2) {
                                $data_nilai = [
                                    'nilai' => $nilai_huruf,
                                    'nilai_geuchik' => $nilai_geuchik[$index],
                                    'id_user' => session('nip'),
                                    'nilai_des' => $nilai_akhir[$index] ?? null,
                                    'nilai_dosen' => null,
                                ];
                                $result = Dosen::updateData('npm', $n, 'id_periode', $id_periode, 'nilai_kkn_non_usk', $data_nilai);
                            }
                        }

                        if ($result) {
                            $data_master_desa = [
                                'tgl_pdf_nilai' => date("d/m/Y"),
                                'tgl_pdf_nilai_geuchik' => date("d/m/Y"),
                                'pdf_nilai_dpl' => basename($upload_data),
                                'pdf_nilai_geuchik' => basename($upload_data_geuchik)
                            ];

                            $result = Dosen::updateData('id', $id_kelompok, 'periode', $id_periode, 'master_desa', $data_master_desa);
                        }

                        return response()->json([
                            'status' => $result,
                            'pesan' => $result ? 'Nilai berhasil diunggah' : 'Gagal mengunggah nilai',
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'pesan' => 'Harap upload file nilai geuchik',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'pesan' => 'Harap upload file nilai',
                ]);
            }
    }

    private function convertToNilaiHuruf($nilai)
    {
        if ($nilai >= 87) {
            return 'A';
        } elseif ($nilai >= 78 && $nilai < 87) {
            return 'AB';
        } elseif ($nilai >= 69 && $nilai < 78) {
            return 'B';
        } elseif ($nilai >= 60 && $nilai < 69) {
            return 'BC';
        } elseif ($nilai >= 51 && $nilai < 60) {
            return 'C';
        } elseif ($nilai >= 41 && $nilai < 51) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
