<?php

namespace App\Models;

use DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function getNilaiAll($idPeriode)
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

        $results = $sql1->union($sql2)->get();

        return $results;
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

    public static function getMhs($id_periode)
    {
        $sql = "select k.*, f.nama_fakultas as fakultas, p.nama_prodi as prodi, concat(substring(m.kd_kelompok, 1, length(pr.kode)), lpad(substring(m.kd_kelompok, length(pr.kode)+1), 3, '0')) as kd_kelompok,
                m.proposal_kkn, m.penetapan_kkn, m.laporan_kkn, IF(k.nim13 = m.nim_ketua, 'Ketua', 'Anggota') as status_keanggotaan, m.nama_desa, m.nama_kecamatan,
                d.nama as nama_dpl, l.logbook_1, l.logbook_2, l.logbook_3, l.logbook_4, l.youtube_1, l.youtube_2, l.youtube_3, l.youtube_4, r.name as kabupaten_domisili,
                v.name as provinsi_domisili from kkn k
                left join prodi p on p.kd_fjjp7 = substring(k.nim13, 3, 7)
                left join fakultas f on f.kd_fakultas2 = k.kd_fakultas
                left join master_desa m on k.kelompok = m.id
                left join dosen d on m.nip_dpl = d.nip and d.id_periode = k.periode
                left join logbook l on k.logbook = l.id
                left join regencies r on r.id = k.id_kabupaten
                left join provinces v on v.id = r.province_id
                left join periode pr on pr.id = k.periode
                where k.periode = ?";

        $data_mhs = DB::select($sql, [$id_periode]);

        foreach ($data_mhs as &$data) {
            if ($data->kelompok === "" || $data->kelompok === null || $data->kelompok === "X") {
                $data->kd_kelompok = "Belum ada kelompok";
                $data->kabupaten_penempatan = "";
            } else {
                if ($data->kelompok !== "Nonaktif") {
                    $lokasi = DB::table('master_desa as m')
                        ->leftJoin('regencies as r', 'r.id', '=', 'm.kd_kabkota')
                        ->select('r.name as kabupaten_penempatan')
                        ->where('m.id', $data->kelompok)
                        ->first();
                    $data->kabupaten_penempatan = $lokasi->kabupaten_penempatan ?? "";
                }
            }
            if ($data->status_reg === 0) {
                $data->kd_kelompok = "Nonaktif";
            }
            $data->link_1 = explode("; ", $data->youtube_1);
            $data->link_2 = explode("; ", $data->youtube_2);
            $data->link_3 = explode("; ", $data->youtube_3);
            $data->link_4 = explode("; ", $data->youtube_4);
        }

        return $data_mhs;
    }

    public static function getKelompok($idPeriode)
    {
        $dataDosen = DB::table('master_desa')
            ->where('periode', $idPeriode)
            ->whereNotNull('kd_kelompok')
            ->where('kd_kelompok', '<>', '')
            ->orderBy('kd_kecamatan')
            ->get();

        foreach ($dataDosen as $data) {
            if ($data->nip_dpl) {
                $data->nama_dpl = self::getNamaDosen($data->nip_dpl, $idPeriode);
            } else {
                $data->nama_dpl = "";
            }
        }

        return $dataDosen;
    }

    public static function updateBatasWaktu($data, $id_periode)
    {
        $data_periode = DB::table('periode')->where('id', $id_periode)->first();
        $id_batas_waktu = $data_periode->batasan_waktu;

        if (is_null($id_batas_waktu) || $id_batas_waktu == 0) {
            $id_batas_waktu_baru = DB::table('batasan_waktu')->insertGetId($data);
            $status = DB::table('periode')->where('id', $id_periode)->update(['batasan_waktu' => $id_batas_waktu_baru]);
        } else {
            $status = DB::table('batasan_waktu')->where('id', $id_batas_waktu)->update($data);
        }

        return $status !== false;
    }

    public static function getStatusNilaiMhs($id_periode)
    {
        $query = DB::table('dbkkn.periode')
            ->select('status_nilai_mhs')
            ->where('id', $id_periode)
            ->first();

        return $query ? $query->status_nilai_mhs : null;
    }

    public static function cekNip($nip, $id_periode)
    {
        $result = DB::table('dbkkn.dosen')
            ->where('nip', $nip)
            ->where('id_periode', $id_periode)
            ->exists();

        return $result ? "exist" : "";
    }

    public static function connectDbKpa()
    {
        try {
            $connection = DB::connection('kpa');
            $connection->getPdo(); // Check if connection is established
            return $connection;
        } catch (\Exception $e) {
            dd("Connection failed: " . $e->getMessage());
        }
    }

    public static function getDataDosen($nip)
    {
        $sql = "SELECT CONCAT(COALESCE(v.gelar_depan, ''),' ',v.nama,' ',COALESCE(v.gelar_blk, '')) as nama, v.tgllahir, v.nip_baru, v.kd_fakultas, p.nama_unit
                FROM kpa.pegawai as v
                LEFT JOIN kpa.fakultas as f on v.kd_fakultas = f.kd_fakultas
                LEFT JOIN kpa.pejabat as p on v.home_base = CONCAT(p.kode_unit,p.pejabat1,p.pejabat2,p.eselon2,p.eselon3,p.eselon4)
                WHERE v.tenaga = 1 and v.nip_baru = ?";

        // Log::info('SQL Query:', ['query' => $sql, 'nip' => $nip]);

        $result = self::connectDbKpa()->select($sql, [$nip]);
        // Log::info('Query Result:', ['result' => $result]);
        return collect($result);
    }

    public static function getStatusGenerator($id_periode)
    {
        $status = DB::table('team_generator')
            ->where('id_periode', $id_periode)
            ->value('status');

        if ($status !== null) {
            return $status == "1"; // tidak terkunci jika status == "1"
        } else {
            return false;
        }
    }

    public static function updateData3($column1, $id1, $column2, $id2, $table, $data)
    {
        $updated = DB::table($table)
            ->where($column1, $id1)
            ->where($column2, $id2)
            ->update($data);

        return $updated ? "success" : "failed";
    }

    public static function cekKetuaKelompok($id_periode)
    {
        $jumlah = DB::table('master_desa')
            ->where('periode', $id_periode)
            ->whereNull('nim_ketua')
            ->whereNotNull('nama_desa')
            ->count();

        return $jumlah;
    }

    public static function cekKdKelompok($kd_kelompok, $periode)
    {
        $result = DB::table('master_desa')
            ->where('kd_kelompok', $kd_kelompok)
            ->where('periode', $periode)
            ->first();

        return $result ? $result->id : 0;
    }

    // Menghitung jumlah data peserta berdasarkan periode dan status_reg
    public static function getJumlahData($table, $id_periode)
    {
        $query = DB::table($table)
            ->where('periode', $id_periode)
            ->where('status_reg', 1)
            ->count();

        return $query;
    }

    // Menghitung jumlah desa berdasarkan periode dengan nama_desa yang tidak null atau kosong
    public static function getJumlahDesa($table, $id_periode)
    {
        $query = DB::table($table)
            ->where('periode', $id_periode)
            ->whereNotNull('nama_desa')
            ->where('nama_desa', '<>', '')
            ->count();

        return $query;
    }

    // Menghitung jumlah data peserta berdasarkan jenis kelamin, periode, dan status_reg
    public static function getJumlahDataJk($table, $id_periode, $condition)
    {
        $query = DB::table($table)
            ->where('periode', $id_periode)
            ->where('jenis_kelamin', $condition)
            ->where('status_reg', 1)
            ->count();

        return $query;
    }

    public static function generatePeserta($id_periode, $jumlah_lk, $jumlah_sisa, $jumlah_peserta_per_kelompok)
    {
        // Query untuk mendapatkan desa dengan nama desa yang tidak kosong
        $data_master_desa = DB::table('master_desa')
            ->where('periode', $id_periode)
            ->whereNotNull('nama_desa')
            ->where('nama_desa', '<>', '')
            ->get();

        // Reset semua kelompok menjadi kosong
        DB::table('kkn')
            ->where('status_reg', 1)
            ->where('periode', $id_periode)
            ->update(['kelompok' => '']);

        $k = ($jumlah_peserta_per_kelompok < 3) ? $jumlah_peserta_per_kelompok : 3;

        if ($data_master_desa->isNotEmpty()) {
            $i = 1;
            $prodi = [];

            foreach ($data_master_desa as $data_kelompok) {
                $prodi[$data_kelompok->id] = [];

                // Data kode KKN yang akan diupdate di master_desa
                $data_kode_kkn = [
                    'nim_ketua' => null,
                    'proposal_kkn' => null,
                    'penetapan_kkn' => null,
                    'laporan_kkn' => null,
                    'monev' => null,
                    'laporan_survey' => null,
                    'tgl_pdf_nilai' => null,
                    'user_uploadpdfnilai' => null,
                    'user_uploadlaporan' => null,
                ];

                // Update data master_desa
                $result = self::updateData($data_kelompok->id, 'master_desa', $data_kode_kkn);
                if ($result !== 'failed') {
                    $data_prodi = [];
                    $lk = 0;
                    $count = 0;

                    for ($j = 0; $j < $jumlah_lk; $j++) {
                        $sql = "SELECT * FROM kkn
                                WHERE (kelompok IS NULL OR kelompok = '')
                                AND jenis_kelamin = 'Laki-laki'
                                AND status_reg = 1
                                AND periode = ?
                                AND kd_fjjp7 NOT IN (?)
                                ORDER BY RAND() LIMIT 1";
                        $result_query = DB::select($sql, [$id_periode, implode("', '", $prodi[$data_kelompok->id])]);

                        if (empty($result_query)) {
                            $sql = "SELECT * FROM kkn
                                    WHERE (kelompok IS NULL OR kelompok = '')
                                    AND jenis_kelamin = 'Laki-laki'
                                    AND status_reg = 1
                                    AND periode = ?
                                    ORDER BY RAND() LIMIT 1";
                            $result_query = DB::select($sql, [$id_periode]);
                        }

                        $lk++;
                        $data_mhs = $result_query[0];
                        $data_prodi[$j] = $data_mhs->kd_fjjp7;

                        // Update kelompok mahasiswa
                        DB::table('kkn')
                            ->where('nim13', $data_mhs->nim13)
                            ->where('periode', $data_mhs->periode)
                            ->update(['kelompok' => $data_kelompok->id]);

                        $count++;
                    }

                    $i++;
                    $prodi[$data_kelompok->id] = $data_prodi;
                    $data_kelompok->jumlah_terisi = $count;
                }
            }

            foreach ($data_master_desa as $data_kelompok) {
                $count = 0;
                $data_prodi = [];

                for ($j = 0; $j < $jumlah_peserta_per_kelompok - $jumlah_lk; $j++) {
                    if ($jumlah_lk + $count <= $k) {
                        $sql = "SELECT * FROM kkn
                                WHERE (kelompok IS NULL OR kelompok = '')
                                AND status_reg = 1
                                AND periode = ?
                                AND kd_fjjp7 NOT IN (?)
                                ORDER BY RAND() LIMIT 1";
                        $result_query = DB::select($sql, [$id_periode, implode("', '", $prodi[$data_kelompok->id])]);

                        if (empty($result_query)) {
                            $sql = "SELECT * FROM kkn
                                    WHERE (kelompok IS NULL OR kelompok = '')
                                    AND status_reg = 1
                                    AND periode = ?
                                    ORDER BY RAND() LIMIT 1";
                            $result_query = DB::select($sql, [$id_periode]);
                        }
                    } else {
                        $sql = "SELECT * FROM kkn
                                WHERE (kelompok IS NULL OR kelompok = '')
                                AND status_reg = 1
                                AND periode = ?
                                ORDER BY RAND() LIMIT 1";
                        $result_query = DB::select($sql, [$id_periode]);
                    }

                    $data_mhs = $result_query[0];
                    $data_prodi[$j] = $data_mhs->kd_fjjp7;

                    // Update kelompok mahasiswa
                    DB::table('kkn')
                        ->where('nim13', $data_mhs->nim13)
                        ->where('periode', $data_mhs->periode)
                        ->update(['kelompok' => $data_kelompok->id]);

                    $count++;
                }

                $prodi[$data_kelompok->id] = $data_prodi;
                $data_kelompok->jumlah_terisi += $count;
            }

            $k = 0;

            foreach ($data_master_desa as $data_kelompok) {
                $jumlah_peserta = ($k < $jumlah_sisa) ? $jumlah_peserta_per_kelompok + 1 : $jumlah_peserta_per_kelompok;

                if ($data_kelompok->jumlah_terisi < $jumlah_peserta) {
                    $jumlah_kurang = $jumlah_peserta - $data_kelompok->jumlah_terisi;
                    $sql = "SELECT * FROM kkn
                            WHERE (kelompok IS NULL OR kelompok = '')
                            AND status_reg = 1
                            AND periode = ?
                            ORDER BY RAND() LIMIT ?";
                    $result_query = DB::select($sql, [$id_periode, $jumlah_kurang]);

                    if (!empty($result_query)) {
                        foreach ($result_query as $data) {
                            DB::table('kkn')
                                ->where('nim13', $data->nim13)
                                ->where('periode', $data->periode)
                                ->update(['kelompok' => $data_kelompok->id]);

                            $data_kelompok->jumlah_terisi++;
                        }
                    }
                }

                $k++;
                $result = self::updateData($data_kelompok->id, 'master_desa', ['jumlah_terisi' => $data_kelompok->jumlah_terisi]);

                if ($result === 'failed') {
                    return 'failed';
                }
            }
        } else {
            return 'failed';
        }

        return 'Berhasil';
    }
}
