<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use DB;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    public $timestamps = false;

    public static function getDosen($id)
    {
        return self::select('dosen.*', 'fakultas_dosen.nama_fakultas as fakultas')
            ->leftJoin('fakultas_dosen', 'dosen.fakultas', '=', 'fakultas_dosen.kd_fakultas')
            ->where('dosen.id_periode', $id)
            ->where('dosen.status', '<>', 'verifikator')
            ->get();
    }

    public static function getDosen2($nip)
    {
        return DB::table('dosen as d')
            ->leftJoin('fakultas_dosen as f', 'd.fakultas', '=', 'f.kd_fakultas')
            ->where('d.nip', $nip)
            ->first();
    }

    public static function getAllKelompok($nip_dpl)
    {
        $sql = "SELECT
                    CONCAT(SUBSTRING(m.kd_kelompok, 1, 3), LPAD(SUBSTRING(kd_kelompok, 4, 3), 3, '0')) AS kd_kelompok,
                    k.nama_mhs AS ketua_kel,
                    p.masa_periode,
                    j.kategori,
                    m.kd_kabkota,
                    m.jumlah_terisi,
                    m.nama_desa,
                    m.nama_kecamatan,
                    m.id,
                    m.nip_korcam
                FROM master_desa m
                LEFT JOIN periode p ON p.id = m.periode
                LEFT JOIN jenis_kkn j ON j.id = p.jenis_kkn
                LEFT JOIN team_generator t ON t.id_periode = m.periode
                LEFT JOIN kkn k ON m.nim_ketua = k.nim13 AND m.periode = k.periode
                WHERE m.nip_dpl = ?
                  AND p.status = 1
                  AND t.status = '0'";

        $results = DB::select($sql, [$nip_dpl]);

        foreach ($results as $data) {
            $lokasi = self::getLokasi($data->kd_kabkota);
            $data->lokasi_penempatan = "Desa " . ucwords(strtolower($data->nama_desa)) . ", Kecamatan " . ucwords(strtolower($data->nama_kecamatan)) . ", Kabupaten " . $lokasi;
            $data->periode = "Periode " . preg_replace("/\((.*?)\)/", "", $data->masa_periode);
        }

        return $results;
    }

    public static function getAllKelompokKorcam($nip_korcam)
    {
        $sql = "SELECT
                    pr.masa_periode,
                    CONCAT(SUBSTRING(m.kd_kelompok, 1, LENGTH(pr.kode)), LPAD(SUBSTRING(m.kd_kelompok, LENGTH(pr.kode) + 1), 3, '0')) AS kd_kelompok,
                    j.kategori,
                    m.nama_desa,
                    m.nip_dpl,
                    m.nama_kecamatan,
                    m.id
                FROM master_desa m
                LEFT JOIN periode pr ON pr.id = m.periode
                LEFT JOIN jenis_kkn j ON j.id = pr.jenis_kkn
                LEFT JOIN team_generator t ON t.id_periode = m.periode
                WHERE m.nip_korcam = ?
                  AND pr.status = 1
                  AND t.status = '0'
                  AND m.nama_desa IS NOT NULL";

        $results = DB::select($sql, [$nip_korcam]);

        foreach ($results as $data) {
            $data->nama_dpl = self::getDosen2($data->nip_dpl)->nama;
            $data->periode = "Periode " . preg_replace("/\((.*?)\)/", "", $data->masa_periode);
        }

        return $results;
    }

    public static function getLokasi($id_kabupaten)
    {
        $sql = "SELECT * FROM regencies WHERE id = ?";
        $regencies = DB::select($sql, [$id_kabupaten]);
        $data = "";

        if (count($regencies) > 0) {
            foreach ($regencies as $data_lokasi) {
                $sql = "SELECT regencies.name AS kabupaten, provinces.name AS provinsi
                        FROM regencies, provinces
                        WHERE regencies.province_id = provinces.id
                          AND regencies.id = ?";
                $data_kabupaten = DB::selectOne($sql, [$data_lokasi->id]);

                $kabupaten = ucwords(strtolower($data_kabupaten->kabupaten)) . ", " . ucwords(strtolower($data_kabupaten->provinsi));

                if ($data) {
                    $data = $data . " # " . $kabupaten;
                } else {
                    $data = $kabupaten;
                }
            }
        } else {
            $data = "-";
        }

        return $data;
    }

    public function getKelompok($idKelompok)
    {
        return DB::table('master_desa')->where('id', $idKelompok)->first();
    }

    public function getPeriode($periodeId)
    {
        return DB::table('periode')->where('id', $periodeId)->first();
    }

    public function getStatusDosen($nip, $periodeId)
    {
        return DB::table('dosen')->where('nip', $nip)->where('id_periode', $periodeId)->first();
    }

    public function getMhs($idKelompok)
    {
        $query = DB::select("
            SELECT k.nim13 as npm, k.agama, k.talenta, k.nama_mhs, k.no_telp_mhs as no_hp, k.kelompok, k.logbook,
                   k.periode as id_periode, p.nama_prodi as jurusan, f.nama_fakultas as fakultas, 1 as asal
            FROM dbkkn.kkn k
            LEFT JOIN prodi p ON p.kd_fjjp7 = SUBSTRING(k.nim13, 3, 7)
            LEFT JOIN fakultas f ON f.kd_fakultas2 = SUBSTRING(k.nim13, 3, 2)
            WHERE k.kelompok = ?
            UNION
            SELECT k.npm, k.agama, '-', k.nama_mhs, k.no_hp, k.kelompok, k.logbook, k.id_periode, p.nama_prodi
                   AS jurusan, pt.nama_ptn AS fakultas, 2 AS asal
            FROM kkn_non_usk k
            LEFT JOIN prodi_non_usk p ON p.kode_prodi = k.kode_prodi
            LEFT JOIN ptn pt ON pt.kode_ptn = p.kode_ptn
            WHERE k.kelompok = ?
        ", [$idKelompok, $idKelompok]);

        foreach ($query as $data) {
            $data->status = $this->getStatusAnggota($data->kelompok, $data->npm);
            if (!$data->logbook) {
                $data->logbook_1 = null;
                $data->logbook_2 = null;
                $data->logbook_3 = null;
                $data->logbook_4 = null;
                $data->link_1 = null;
                $data->link_2 = null;
                $data->link_3 = null;
                $data->link_4 = null;
            } else {
                $data->logbook_1 = $this->getLogbook($data->logbook, "logbook_1");
                $data->logbook_2 = $this->getLogbook($data->logbook, "logbook_2");
                $data->logbook_3 = $this->getLogbook($data->logbook, "logbook_3");
                $data->logbook_4 = $this->getLogbook($data->logbook, "logbook_4");
                $data->link_1 = $this->getLogbook($data->logbook, "youtube_1");
                $data->link_2 = $this->getLogbook($data->logbook, "youtube_2");
                $data->link_3 = $this->getLogbook($data->logbook, "youtube_3");
                $data->link_4 = $this->getLogbook($data->logbook, "youtube_4");
            }
        }

        return $query;
    }

    private function getStatusAnggota($idKel, $nim)
    {
        $query = DB::select("SELECT nim_ketua FROM dbkkn.master_desa WHERE id = ?", [$idKel]);
        if (count($query) > 0 && $query[0]->nim_ketua === $nim) {
            return "Ketua";
        } else {
            return "Anggota";
        }
    }

    private function getLogbook($id, $column)
    {
        $query = DB::select("SELECT * FROM dbkkn.logbook WHERE id = ?", [$id]);
        if (count($query) > 0 && empty($query[0]->$column)) {
            return "Belum diunggah";
        } else {
            return $query[0]->$column ?? "Belum diunggah";
        }
    }

    public function getJenisKkn($id_jenis)
    {
        $result = DB::table('dbkkn.jenis_kkn')
            ->where('id', $id_jenis)
            ->first();

        return $result ? $result->kategori : "";
    }

    public static function insertDokumen($column, $namaDoc, $idKelompok)
    {
        return DB::table('master_desa')
            ->where('id', $idKelompok)
            ->update([$column => $namaDoc]);
    }
}
