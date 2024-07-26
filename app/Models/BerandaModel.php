<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BerandaModel extends Model
{
    use HasFactory;

    public function getBatasanWaktu($batasanWaktuId)
    {
        return DB::table('batasan_waktu')->where('id', $batasanWaktuId)->first();
    }

    public function getPeriode($idPeriode)
    {
        return DB::table('periode')->where('id', $idPeriode)->first();
    }

    public function getJenisKkn($id)
    {
        $result = DB::table('dbkkn.jenis_kkn')
                    ->where('id', $id)
                    ->first();

        if ($result) {
            return $result->kategori;
        } else {
            return null;
        }
    }

    public function getMhs($nim)
    {
        $result = DB::table('kkn')
            ->leftJoin('periode', 'periode.id', '=', 'kkn.periode')
            ->leftJoin('prodi', DB::raw('substring(kkn.nim13, 3, 7)'), '=', 'prodi.kd_fjjp7')
            ->leftJoin('fakultas', DB::raw('substring(kkn.nim13, 3, 2)'), '=', 'fakultas.kd_fakultas2')
            ->select('kkn.*', 'prodi.nama_prodi as nama_prodi', 'fakultas.nama_fakultas as nama_fakultas')
            ->where('kkn.nim13', $nim)
            ->where('periode.status', 1)
            ->where('kkn.status_reg', 1)
            ->first();

        if ($result) {
            return (array) $result;
        } else {
            return 0;
        }
    }

    public function getStatusGenerator($idPeriode)
    {
        $result = DB::table('team_generator')
            ->select('status')
            ->where('id_periode', $idPeriode)
            ->first();

        if ($result && $result->status == 1) { // tidak terkunci
            return true;
        }

        return false;
    }

    public function getKelompok($idKel)
    {
        return DB::table('master_desa')
            ->where('id', $idKel)
            ->first();
    }

    public function getKetuaKelompok($idKel, $nim)
    {
        $result = DB::table('master_desa')
            ->select('nim_ketua')
            ->where('id', $idKel)
            ->first();

        if ($result && $result->nim_ketua === $nim) {
            return "Ketua";
        }

        return "Anggota";
    }

    public function getRegencies($id)
    {
        $result = DB::table('regencies')
            ->where('id', $id)
            ->first();

        return $result->name;
    }

    public function getDpl($nip, $idPeriode)
    {
        $result = DB::table('dosen')
            ->where('nip', $nip)
            ->where('id_periode', $idPeriode)
            ->first();

        return $result->nama;
    }

    public function getMhsKel($idKel)
    {
        $result = DB::table('kkn')
            ->leftJoin('prodi', DB::raw('substring(kkn.nim13, 3, 7)'), '=', 'prodi.kd_fjjp7')
            ->leftJoin('fakultas', DB::raw('substring(kkn.nim13, 3, 2)'), '=', 'fakultas.kd_fakultas2')
            ->where('kkn.kelompok', $idKel)
            ->select(
                'kkn.nim13 as npm',
                'kkn.nama_mhs',
                'kkn.no_telp_mhs as no_hp',
                'kkn.kelompok',
                'kkn.logbook',
                'kkn.periode as id_periode',
                'kkn.jenis_kelamin',
                'prodi.nama_prodi as jurusan',
                'fakultas.nama_fakultas as fakultas',
                DB::raw('1 as asal')
            )
            ->unionAll(
                DB::table('kkn_non_usk')
                    ->leftJoin('prodi_non_usk', 'kkn_non_usk.kode_prodi', '=', 'prodi_non_usk.kode_prodi')
                    ->leftJoin('ptn', 'prodi_non_usk.kode_ptn', '=', 'ptn.kode_ptn')
                    ->where('kkn_non_usk.kelompok', $idKel)
                    ->select(
                        'kkn_non_usk.npm',
                        'kkn_non_usk.nama_mhs',
                        'kkn_non_usk.no_hp',
                        'kkn_non_usk.kelompok',
                        'kkn_non_usk.logbook',
                        'kkn_non_usk.id_periode',
                        'kkn_non_usk.jenis_kelamin',
                        'prodi_non_usk.nama_prodi as jurusan',
                        'ptn.nama_ptn as fakultas',
                        DB::raw('2 as asal')
                    )
            )
            ->get();

        if ($result->count() > 0) {
            foreach ($result as $data) {
                $data->status = $this->getKetuaKelompok($data->kelompok, $data->npm);
            }
        }

        return $result;
    }

    public function getNilaiMhs($id_periode, $nim)
    {
        $query = DB::select("SELECT * FROM dbkkn.nilai_kkn WHERE periode = ? AND nim13 = ?", [$id_periode, $nim]);
        return $query ? $query[0] : null;
    }

    public static function insertBerkas($data_dokumen, $nim, $periode)
    {
        DB::table('kkn')
            ->where('nim13', $nim)
            ->where('periode', $periode)
            ->update($data_dokumen);

        return true;
    }

    public static function insertDokumen($data_dokumen, $id_kelompok)
    {
        DB::table('master_desa')
            ->where('id', $id_kelompok)
            ->update($data_dokumen);

        return true;
    }

    public static function insertLogbook($urutanLogbook, $logbookData, $nim)
    {
        // Ambil data mahasiswa
        $dataMhs = DB::table('dbkkn.kkn')->where('nim13', $nim)->first();

        if (!$dataMhs) {
            return 0; // Mahasiswa tidak ditemukan
        }

        $idLogbook = $dataMhs->logbook;

        if (is_null($idLogbook) || $idLogbook == 0) {
            // Insert new logbook
            $insertId = DB::table('logbook')->insertGetId($logbookData);

            if ($insertId == 0) {
                return 0; // Gagal menyimpan logbook
            } else {
                // Update mahasiswa dengan logbook ID baru
                $updateResult = DB::table('dbkkn.kkn')
                    ->where('nim13', $nim)
                    ->where('periode', $dataMhs->periode)
                    ->update(['logbook' => $insertId]);

                return $updateResult ? 1 : 0;
            }
        } else {
            // Update existing logbook
            $updateResult = DB::table('logbook')
                ->where('id', $idLogbook)
                ->update($logbookData);

            return $updateResult ? 1 : 0;
        }
    }

    public static function getLogbook($nim, $urutanLogbook)
    {
        $dataMhs = DB::table('dbkkn.kkn')->where('nim13', $nim)->first();

        if (!$dataMhs) {
            return "";
        }

        $idLogbook = $dataMhs->logbook;

        if (!is_null($idLogbook) && $idLogbook != "0") {
            $data = DB::table('logbook')->where('id', $idLogbook)->first();

            // if ($data) {
            //     return $data->$urutanLogbook;
            if ($data) {
                $urutanField = "logbook_" . $urutanLogbook;
                return $data->$urutanField ?? "";
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function getLinks($nim, $urutanLink)
    {
        $dataMhs = DB::table('dbkkn.kkn')->where('nim13', $nim)->first();

        if (!$dataMhs) {
            return "";
        }

        $idLogbook = $dataMhs->logbook;

        if (!is_null($idLogbook) && $idLogbook != "0") {
            $data = DB::table('logbook')->where('id', $idLogbook)->first();

            if ($data) {
                $urutanField = "youtube_" . $urutanLink;
                $linkStr = preg_replace("/\; /", "<br>", $data->$urutanField);
                return $linkStr ?? "";
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
}
