<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

}
