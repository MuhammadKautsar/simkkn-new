<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use DB;

class PanitiaModel extends Model
{
    use HasFactory;

    function get_all_periode()
    {
        $sql = "SELECT * FROM dbkkn.periode p WHERE p.status <> 2 ORDER BY p.id DESC";
        $result = DB::select($sql);

        if (count($result) > 0) {
            foreach ($result as $data) {
                if ($data->jenis_kkn === "" || $data->jenis_kkn === "0") {
                    $data->jenis_kkn = "-";
                } else {
                    $data->jenis_kkn = $this->get_jenis_kkn($data->jenis_kkn);
                }

                if ($data->lokasi === '0') {
                    $data_lokasi = DB::table('lokasi_kkn')->where('id_periode', $data->id)->get();

                    if (count($data_lokasi) > 0) {
                        foreach ($data_lokasi as $lokasi) {
                            $data_kabupaten = DB::table('regencies')
                                ->join('provinces', 'regencies.province_id', '=', 'provinces.id')
                                ->where('regencies.id', $lokasi->id_kabupaten)
                                ->select('regencies.name as kabupaten', 'provinces.name as provinsi')
                                ->first();

                            if ($data_kabupaten) {
                                $kabupaten = ucwords(strtolower($data_kabupaten->provinsi)) . " - " . ucwords(strtolower($data_kabupaten->kabupaten));
                            }

                            if ($data->lokasi) {
                                $data->lokasi = $data->lokasi . " # " . $kabupaten;
                            } else {
                                $data->lokasi = $kabupaten;
                            }
                        }
                    } else {
                        $data->lokasi = "-";
                    }
                }

                $masa_periode = $data->masa_periode;
                $nama = preg_replace("/\((.*?)\)/", "", $masa_periode);
                preg_match('/\((.*?)\)/', $masa_periode, $masa);
                $data->masa_kegiatan = $masa[1];
                $data->masa_periode = "Periode " . $nama;
            }
        }

        return $result;
    }

    function get_jenis_kkn($id)
    {
        $sql = "SELECT * FROM jenis_kkn WHERE id = ?";
        $result = DB::selectOne($sql, [$id]);

        if ($result) {
            return $result->kategori;
        }

        return null;
    }

    public function getDesaPerPeriode($id_periode)
    {
        $query = "
            SELECT
                m.id as id,
                m.periode,
                m.nama_kecamatan,
                m.nama_desa,
                m.nama_geuchik,
                m.no_hp_geuchik,
                m.nip_dpl,
                m.nip_korcam,
                m.nip_verifikator,
                concat(substring(m.kd_kelompok, 1, length(p.kode)), lpad(substring(m.kd_kelompok, length(p.kode)+1), 3, '0')) as kd_kelompok,
                r.name as nama_kabupaten,
                p.jenis_kkn
            FROM
                master_desa m
            JOIN
                regencies r ON m.kd_kabkota = r.id
            JOIN
                periode p ON p.id = m.periode
            WHERE
                periode = ?
                AND m.nama_desa IS NOT NULL
        ";

        $results = DB::select($query, [$id_periode]);

        $data_row = [];

        foreach ($results as $data) {
            $data_column = [];
            $jenis_kkn = ucwords(strtolower($data->jenis_kkn));
            $data_column["id"] = $data->id;
            $data_column["nama_kecamatan"] = ucwords(strtolower($data->nama_kabupaten . " - " . $data->nama_kecamatan));
            $data_column["nama_desa"] = ucwords(strtolower($data->nama_desa));
            $data_column["nama_kepala_desa"] = ucwords(strtolower($data->nama_geuchik));
            $data_column["no_kepala_desa"] = $data->no_hp_geuchik;
            $data_column["nama_geuchik"] = ucwords(strtolower($data->nama_geuchik));
            $data_column["jenis_kkn"] = $jenis_kkn;
            $data_column["status"] = $this->getStatusPeriode($id_periode);

            $data_column["nama_dpl"] = $data->nip_dpl ? $this->getNamaDosen($data->nip_dpl, $data->periode) : "";
            $data_column["nama_korcam"] = $data->nip_korcam ? $this->getNamaDosen($data->nip_korcam, $data->periode) : "";
            $data_column["nama_verifikator"] = ($jenis_kkn == '10' && $data->nip_verifikator) ? $this->getNamaDosen($data->nip_verifikator, $data->periode) : "";

            if (auth()->user()->level !== "1" && $data_column["status"]) {
                $data_column['aksi'] = '<a href="" class="delete-data" data-doc="desa" data-val=' . $data->id . '><i class="fas fa-trash"></i></a>
                <a href="" data-toggle="modal" data-target="#dplModal" data-id=' . $data->id . ' data-geuchik ="' . $data_column["nama_geuchik"] . '" data-kecamatan ="' . $data_column["nama_kecamatan"]  . '" data-desa ="' . $data_column["nama_desa"] . '" class="ganti-dpl"><i class="fas fa-cog"></i></a>';
            } else {
                $data_column['aksi'] = "";
            }

            $data_column["kd_kelompok"] = $data->kd_kelompok == "000" ? "" : $data->kd_kelompok;
            $data_row[] = $data_column;
        }

        return $data_row;
    }

    private function getStatusPeriode($id_periode)
    {
        // Implementasi fungsi ini sesuai kebutuhan
    }

    private function getNamaDosen($nip, $periode)
    {
        // Implementasi fungsi ini sesuai kebutuhan
    }

    public static function getNilaiAll($idPeriode, $perPage = 10)
    {
        $sql1 = DB::table('nilai_kkn as n')
            ->leftJoin('kkn as k', 'k.nim13', '=', 'n.nim13')
            ->leftJoin('master_desa as m', 'm.id', '=', 'k.kelompok')
            ->leftJoin('dosen as d', 'd.nip', '=', 'm.nip_dpl')
            ->leftJoin('prodi as p', DB::raw('substring(k.nim13, 3, 7)'), '=', 'p.kd_fjjp7')
            ->leftJoin('fakultas as f', 'p.kd_fakultas2', '=', 'f.kd_fakultas2')
            ->where('n.periode', $idPeriode)
            ->where('d.id_periode', $idPeriode)
            ->select(
                'k.nim13', 'k.nama_mhs', 'n.nilai_dosen', 'n.nilai_geuchik', 'n.nilai_des', 'n.nilai_verified', 'n.nilai',
                'f.nama_fakultas', 'p.nama_prodi', 'm.kd_kelompok', 'd.nama as nama_dpl'
            );

        $sql2 = DB::table('nilai_kkn_non_usk as n')
            ->leftJoin('kkn_non_usk as k', 'k.npm', '=', 'n.npm')
            ->leftJoin('master_desa as m', 'm.id', '=', 'k.kelompok')
            ->leftJoin('dosen as d', 'd.nip', '=', 'm.nip_dpl')
            ->leftJoin('prodi_non_usk as p', 'k.kode_prodi', '=', 'p.kode_prodi')
            ->leftJoin('ptn as pt', 'p.kode_ptn', '=', 'pt.kode_ptn')
            ->where('n.id_periode', $idPeriode)
            ->where('d.id_periode', $idPeriode)
            ->select(
                'k.npm as nim13', 'k.nama_mhs', 'n.nilai_dosen', 'n.nilai_geuchik', 'n.nilai_des', 'n.nilai_verified', 'n.nilai',
                'pt.nama_ptn as nama_fakultas', 'p.nama_prodi', 'm.kd_kelompok', 'd.nama as nama_dpl'
            );

        $results = $sql1->union($sql2)->paginate($perPage);

        return $results;
    }
}
