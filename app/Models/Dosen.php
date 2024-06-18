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

    // public function getDosen($id)
    // {
    //     $result = DB::select("
    //         SELECT d.*, f.nama_fakultas as fakultas
    //         FROM dosen d
    //         LEFT JOIN fakultas_dosen f on d.fakultas = f.kd_fakultas
    //         WHERE id_periode = ? AND status <> 'verifikator'
    //     ", [$id]);

    //     return $result;
    // }

    public static function getDosen($id, $perPage = 10)
    {
        return self::select('dosen.*', 'fakultas_dosen.nama_fakultas as fakultas')
            ->leftJoin('fakultas_dosen', 'dosen.fakultas', '=', 'fakultas_dosen.kd_fakultas')
            ->where('dosen.id_periode', $id)
            ->where('dosen.status', '<>', 'verifikator')
            ->paginate($perPage);
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

    private static function getLokasi($id_kabupaten)
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
}
