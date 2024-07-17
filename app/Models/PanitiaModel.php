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

    public static function getDesaPerPeriode($id_periode)
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
            $data_column["status"] = self::getStatusPeriode($id_periode);

            $data_column["nama_dpl"] = $data->nip_dpl ? self::getNamaDosen($data->nip_dpl, $data->periode) : "";
            $data_column["nama_korcam"] = $data->nip_korcam ? self::getNamaDosen($data->nip_korcam, $data->periode) : "";
            $data_column["nama_verifikator"] = ($jenis_kkn == '10' && $data->nip_verifikator) ? self::getNamaDosen($data->nip_verifikator, $data->periode) : "";

            // if (auth()->user()->level !== "1" && $data_column["status"]) {
            //     $data_column['aksi'] = '<a href="" class="delete-data" data-doc="desa" data-val=' . $data->id . '><i class="fas fa-trash"></i></a>
            //     <a href="" data-toggle="modal" data-target="#dplModal" data-id=' . $data->id . ' data-geuchik ="' . $data_column["nama_geuchik"] . '" data-kecamatan ="' . $data_column["nama_kecamatan"]  . '" data-desa ="' . $data_column["nama_desa"] . '" class="ganti-dpl"><i class="fas fa-cog"></i></a>';
            // } else {
            //     $data_column['aksi'] = "";
            // }

            $data_column["kd_kelompok"] = $data->kd_kelompok == "000" ? "" : $data->kd_kelompok;
            $data_row[] = $data_column;
        }

        return $data_row;
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

    public function getStatusGenerator($idPeriode)
    {
        $status = DB::table('team_generator')
            ->where('id_periode', $idPeriode)
            ->value('status');

        return $status == "1"; // Jika status adalah "1", return true, jika tidak return false.
    }

    public static function updateData($id_periode, $table, $data)
    {
        $result = DB::table($table)->where('id', $id_periode)->update($data);
        return $result ? "success" : "failed";
    }

    public static function getPersyaratan($id_periode)
    {
        return DB::table('persyaratan')->where('id_periode', $id_periode)->get();
    }

    public function checkDosenDplKorcam($id_dosen, $id_periode)
    {
        $sql = "SELECT * FROM master_desa m
                LEFT JOIN dosen d ON m.nip_dpl = d.nip OR m.nip_korcam = d.nip
                WHERE d.id = ? AND m.periode = ?";
        $query_result = DB::select($sql, [$id_dosen, $id_periode]);

        return !empty($query_result);
    }

    public function deleteData($table, $id)
    {
        return DB::table($table)->where('id', $id)->delete();
    }

    public static function cekKabupaten($id_periode, $id_kabupaten)
    {
        $result = DB::table('lokasi_kkn')
                    ->where('id_periode', $id_periode)
                    ->where('id_kabupaten', $id_kabupaten)
                    ->first();
        return $result;
    }

    public static function getKabupatenPerPeriode($idPeriode)
    {
        $lokasiKkn = DB::table('lokasi_kkn')->where('id_periode', $idPeriode)->get();

        if ($lokasiKkn->count() > 0) {
            $dataRow = [];
            foreach ($lokasiKkn as $data) {
                $kabupaten = DB::table('regencies')
                    ->join('provinces', 'regencies.province_id', '=', 'provinces.id')
                    ->where('regencies.id', $data->id_kabupaten)
                    ->select('regencies.id as id', 'regencies.name as kabupaten', 'provinces.name as provinsi')
                    ->first();

                if ($kabupaten) {
                    $dataColumn = [
                        'id' => ucwords(strtolower($kabupaten->id)),
                        'kabupaten' => ucwords(strtolower($kabupaten->kabupaten)),
                        'provinsi' => ucwords(strtolower($kabupaten->provinsi)),
                        'status' => self::getStatusPeriode($idPeriode),
                        'level' => (session('level') === '3')
                    ];
                    $dataRow[] = $dataColumn;
                }
            }
            return $dataRow;
        } else {
            $masterDesa = DB::table('master_desa')->where('periode', $idPeriode)->distinct()->get(['kd_kabkota']);

            if ($masterDesa->count() > 0) {
                $dataRow = [];
                foreach ($masterDesa as $data) {
                    if ($data->kd_kabkota !== 0 && $data->kd_kabkota !== NULL) {
                        $query3 = DB::table('lokasi')->where('id', $data->kd_kabkota)->first();

                        $dataColumn = [
                            'id' => '',
                            'kabupaten' => ucwords(strtolower($query3->nama_lokasi)),
                            'provinsi' => 'Aceh',
                            'status' => self::getStatusPeriode($idPeriode),
                            'level' => (session('level') !== '1')
                        ];
                        $dataRow[] = $dataColumn;
                    }
                }
                return $dataRow;
            } else {
                return [];
            }
        }
    }

    public static function getStatusPeriode($idPeriode)
    {
        $query = DB::table('periode')->where('id', $idPeriode)->first();
        if ($query->status == 1) {
            return "Aktif";
        } else {
            return "";
        }
    }

    public static function getKelompokPerKabupaten($id_periode, $kd_kabkota) {
        return DB::table('master_desa')
            ->where('periode', $id_periode)
            ->where('kd_kabkota', $kd_kabkota)
            ->whereNotNull('nama_kecamatan')
            ->where('nama_kecamatan', '<>', '')
            ->get();
    }

    public static function updateData2($column, $id, $table, $data) {
        $updated = DB::table($table)
            ->where($column, $id)
            ->update($data);

        return $updated ? 'success' : 'failed';
    }

    public static function deleteData2($table, $condition) {
        DB::table($table)->where($condition)->delete();
        return true;
    }

    public static function getDeleteKecamatan($id_data) {
        $result = DB::table('master_desa')->where('id', $id_data)->first();
        return $result ? (array) $result : null;
    }

    public static function getKelompokPerKecamatan($id_periode, $kd_kabkota, $kd_kecamatan) {
        return DB::table('master_desa')
            ->where('periode', $id_periode)
            ->where('kd_kabkota', $kd_kabkota)
            ->where('kd_kecamatan', $kd_kecamatan)
            ->whereNotNull('nama_desa')
            ->where('nama_desa', '<>', '')
            ->get();
    }

    public static function getKorcam($id_periode)
    {
        return DB::table('dosen')
                ->where('id_periode', $id_periode)
                ->where('status', 'korcam')
                ->orderBy('nama')
                ->get();
    }

    public static function getDpl($id_periode)
    {
        return DB::table('dosen')
                ->where('id_periode', $id_periode)
                ->where('status', '!=', 'verifikator')
                ->orderBy('nama')
                ->get();
    }

    public static function cekKecamatan($id_periode, $kd_kecamatan, $kd_kabkota)
    {
        return DB::table('master_desa')
                 ->where('kd_kecamatan', $kd_kecamatan)
                 ->where('kd_kabkota', $kd_kabkota)
                 ->where('periode', $id_periode)
                 ->get();
    }

    public static function getNipDosen($id_dosen)
    {
        $query = DB::table('dosen')->where('id', $id_dosen)->first();
        return isset($query->nip) ? ucwords(strtolower($query->nip)) : "";
    }

    // public static function getPeriode($id_periode)
    // {
    //     $query = DB::table('periode')->where('id', $id_periode)->first();
    //     // Tambahkan logika pemrosesan data sesuai kebutuhan
    //     // Contoh kode pemrosesan data yang kompleks dapat ditambahkan di sini
    //     return $query;
    // }

    public static function getPeriodeJenisKkn($id_periode)
    {
        $jenis_kkn = DB::table('periode')->where('id', $id_periode)->value('jenis_kkn');
        return $jenis_kkn;
    }

    public static function getPeriodeKodeKkn($id_periode)
    {
        $kode = DB::table('periode')->where('id', $id_periode)->value('kode');
        return $kode;
    }

    public static function insertData($table, $data)
    {
        return DB::table($table)->insertGetId($data);
    }

    public static function getKecamatanPerPeriode($id_periode)
    {
        $query = DB::table('master_desa as m')
            ->leftJoin('regencies as r', 'm.kd_kabkota', '=', 'r.id')
            ->leftJoin('provinces as p', 'r.province_id', '=', 'p.id')
            ->select(
                'm.id as id',
                'm.periode',
                'm.kd_kecamatan',
                'm.nama_kecamatan',
                'm.nama_camat',
                'm.no_hp_camat',
                'm.nip_korcam',
                'r.name as kabupaten',
                'p.name as provinsi'
            )
            ->whereIn('m.id', function ($query) use ($id_periode) {
                $query->select(DB::raw('min(id)'))
                    ->from('master_desa')
                    ->where('periode', $id_periode)
                    ->groupBy('nama_kecamatan', 'kd_kabkota');
            })
            ->whereNotNull('m.nama_kecamatan')
            ->where('m.nama_kecamatan', '<>', '')
            ->orderBy('m.nama_kecamatan')
            ->get();

        if ($query->isNotEmpty()) {
            $data_row = [];
            foreach ($query as $data) {
                $data_column = [];
                $data_column["id"] = $data->id;
                $data_column["kd_kecamatan"] = ucwords(strtolower($data->kd_kecamatan));
                $data_column["nama_kecamatan"] = ucwords(strtolower($data->nama_kecamatan));
                $data_column["provinsi"] = ucwords(strtolower($data->provinsi)) . " - " . ucwords(strtolower($data->kabupaten));
                $data_column["nama_camat"] = ucwords(strtolower($data->nama_camat));
                $data_column["no_hp_camat"] = ucwords(strtolower($data->no_hp_camat));
                $data_column["status"] = self::getStatusPeriode($id_periode);

                // if (session('level') === "3" && $data_column["status"]) {
                //     $data_column['aksi'] = '<a href="" class="delete-data" data-doc="kecamatan" data-val='.$data->id.'><i class="fas fa-trash"></i></a>
                //     <a href="" data-toggle="modal" data-target="#korcamModal" data-id ='.$data->id.' data-kecamatan ="'.$data_column["nama_kecamatan"].'" class="ganti-korcam"><i class="fas fa-cog"></i></a>';
                // } elseif (session('level') !== "1" && $data_column["status"]) {
                //     $data_column['aksi'] = '<a href="" data-toggle="modal" data-target="#korcamModal" data-id ='.$data->id.' data-kecamatan ="'.$data_column["nama_kecamatan"].'"
                //                                 class="ganti-korcam"><i class="fas fa-cog"></i></a>';
                // } else {
                //     $data_column['aksi'] = "";
                // }

                if ($data->nip_korcam) {
                    $data_column["nama_korcam"] = ucwords(strtolower(self::getNamaDosen($data->nip_korcam, $data->periode)));
                } else {
                    $data_column["nama_korcam"] = "";
                }

                $data_row[] = $data_column;
            }
            return $data_row;
        } else {
            $query2 = DB::table('master_desa as m')
                ->leftJoin('lokasi', 'm.kd_kabkota', '=', 'lokasi.id')
                ->select(
                    'm.id as id',
                    'm.periode',
                    'm.nama_kecamatan',
                    'm.nama_camat',
                    'm.no_hp_camat',
                    'm.nip_korcam',
                    'lokasi.nama_lokasi as kabupaten'
                )
                ->whereIn('m.id', function ($query) use ($id_periode) {
                    $query->select(DB::raw('min(id)'))
                        ->from('master_desa')
                        ->where('periode', $id_periode)
                        ->groupBy('nama_kecamatan');
                })
                ->whereNotNull('m.nama_kecamatan')
                ->where('m.nama_kecamatan', '<>', '')
                ->get();

            if ($query2->isNotEmpty()) {
                $data_row = [];
                foreach ($query2 as $data) {
                    $data_column = [];
                    $data_column["id"] = ucwords(strtolower($data->id));
                    $data_column["nama_kecamatan"] = ucwords(strtolower($data->nama_kecamatan));
                    $data_column["provinsi"] = "Aceh" . " - " . $data->kabupaten;
                    $data_column["nama_camat"] = ucwords(strtolower($data->nama_camat));
                    $data_column["no_hp_camat"] = ucwords(strtolower($data->no_hp_camat));
                    $data_column["status"] = self::getStatusPeriode($id_periode);

                    if ($data->nip_korcam) {
                        $data_column["nama_korcam"] = ucwords(strtolower(self::getNamaDosen($data->nip_korcam, $data->periode)));
                    } else {
                        $data_column["nama_korcam"] = "";
                    }

                    $data_row[] = $data_column;
                }
                return $data_row;
            } else {
                return [];
            }
        }
    }

    public static function getNamaDosen($nip, $id_periode)
    {
        $query = DB::table('dosen')
            ->where('nip', $nip)
            ->where('id_periode', $id_periode)
            ->first();

        return $query ? ($query->nama ?? "") : "";
    }

    public static function getKecamatan($id_kecamatan)
    {
        return DB::table('master_desa')
            ->where('kd_kecamatan', $id_kecamatan)
            ->first();
    }

    // Function to check if desa exists
    public static function cekDesa($kd_desa, $kd_kecamatan, $kd_kabkota, $periode)
    {
        return DB::table('master_desa')
            ->where('kd_desa', $kd_desa)
            ->where('kd_kecamatan', $kd_kecamatan)
            ->where('kd_kabkota', $kd_kabkota)
            ->where('periode', $periode)
            ->get();
    }

    // Function to check the latest kd_kelompok
    public static function cekKdKelompokTerbaru($id_periode)
    {
        $result = DB::table('master_desa')
            ->select('kd_kelompok')
            ->where('periode', $id_periode)
            ->whereNotNull('kd_kelompok')
            ->where('kd_kelompok', '<>', '')
            ->orderByDesc('id')
            ->first();

        return $result ? $result->kd_kelompok : null;
    }

    // Function to get periode data
    public static function getPeriode($id)
    {
        $hsl = DB::table('dbkkn.periode')
            ->where('id', $id)
            ->first();

        $bulan = array(
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        );

        if ($hsl) {
            if (!$hsl->ket) {
                return [
                    'id' => $hsl->id,
                    'nama' => $hsl->masa_periode,
                    'jenis_kkn' => $hsl->jenis_kkn,
                    'tgl_awal' => "",
                    'tgl_akhir' => "",
                    'kode' => $hsl->kode,
                    'kuota' => $hsl->kuota,
                    'min_sks' => $hsl->min_sks,
                ];
            } else {
                $tgl = explode(" s/d ", $hsl->ket);
                $newformat = [];
                $bulan2 = "";
                $tahun = "";
                for ($i = count($tgl) - 1; $i >= 0; $i--) {
                    $tgl_baru = explode(" ", $tgl[$i]);
                    if (count($tgl_baru) == 2) {
                        $tgl_str = $tgl_baru[0] . "-" . $bulan[$tgl_baru[1]] . "-" . $tahun;
                    } elseif (count($tgl_baru) == 1) {
                        $tgl_str = $tgl_baru[0] . "-" . $bulan2 . "-" . $tahun;
                    } else {
                        $bulan2 = $bulan[$tgl_baru[1]];
                        $tahun = $tgl_baru[2];
                        $tgl_str = $tgl_baru[0] . "-" . $bulan[$tgl_baru[1]] . "-" . $tgl_baru[2];
                    }
                    $time = strtotime($tgl_str);
                    $newformat[$i] = date('Y-m-d', $time);
                }
                $nama_periode = explode(" (", $hsl->masa_periode);
                preg_match('#\((.*?)\)#', $hsl->masa_periode, $match);
                if ($hsl->semester_reg) {
                    $semester = substr($hsl->semester_reg, -1);
                    $tahun = (int)substr($hsl->semester_reg, 0, 4);
                    $tahun = $tahun . "/" . ($tahun + 1);
                } else {
                    $semester = null;
                    $tahun = null;
                }
                return [
                    'id' => $hsl->id,
                    'nama' => $nama_periode[0],
                    'jenis_kkn' => $hsl->jenis_kkn,
                    'masa_kkn' => $match[1],
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'tgl_awal' => $newformat[0],
                    'tgl_akhir' => $newformat[1],
                    'kode' => $hsl->kode,
                    'kuota' => $hsl->kuota,
                    'min_sks' => $hsl->min_sks,
                ];
            }
        }
        return null;
    }

    // Function to update desa data
    public static function updateDataDesa($kd_desa, $id_periode, $data)
    {
        $query = DB::table('master_desa')
            ->where('kd_desa', $kd_desa)
            ->where('periode', $id_periode)
            ->first();

        if ($query) {
            return DB::table('master_desa')
                ->where('kd_desa', $kd_desa)
                ->where('periode', $id_periode)
                ->update($data);
        } else {
            return DB::table('master_desa')
                ->insert($data);
        }
    }
}
