<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;

class DaftarModel extends Model
{
    use HasFactory;

    protected $connection = 'puksi';

    public static function getMhs($nim13)
    {
        $data_mhs = [];
        $result = DB::connection('puksi')->table('mhs')->where('nim13', $nim13)->get();

        if ($result->isNotEmpty()) {
            foreach ($result as $data) {
                $data_mhs['nama'] = self::getMhsMhs($data->nim13, 'nama');
                // $data_mhs['nama'] = $data->nama_mhs;
                $data_mhs['npm'] = $data->nim13;
                $data_mhs['nik'] = $data->nik;
                $data_mhs['tmp_lahir'] = self::getMhsMhs($data->nim13, 'tempat_lahir');
                // $data_mhs['tmp_lahir'] = $data->nmkota_lahir;
                $data_mhs['tgl_lahir'] = $data->tg_lahir;
                $data_mhs['jenis_kelamin'] = self::getMhsMhs($data->nim13, 'jenis_kelamin');
                // $data_mhs['jenis_kelamin'] = $data->jenis_kelamin;
                $data_mhs['sks'] = self::getJumlahSks($data->nim13);
                $data_mhs['email'] = self::getMhsMhs($data->nim13, 'email');
                // $data_mhs['email'] = $data->e_mail;
                $data_mhs['no_hp'] = self::getMhsMhs($data->nim13, 'no_tlp_mhs');
                // $data_mhs['no_hp'] = $data->no_telp_mhs;
                $data_mhs['nama_ibu'] = $data->nama_ibu;
                $data_mhs['nama_ayah'] = $data->nama_ortu;
                $data_mhs['no_hp_ayah'] = $data->no_telp_ortu;
                $data_mhs['nik_ayah'] = $data->nik_ayah;
                $data_mhs['nik_ibu'] = $data->nik_ibu;
                $data_mhs['ayah_hidup'] = $data->ayah_hidup;
                $data_mhs['ibu_hidup'] = $data->ibu_hidup;
            }
        }

        return $data_mhs;
    }

    public static function getMhsMhs($nim13, $field)
    {
        $url = "http://ws.usk.ac.id/webservice/pustaka/mahasiswa/cmahasiswa/mhs/npm/".$nim13."/key/lp2m23mola/";

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $xml = $response->getBody()->getContents();

        $simpleXml = simplexml_load_string($xml);
        $data = (string) $simpleXml->$field;

        return $data;
    }

    public static function getPersyaratan($id_periode)
    {
        return DB::table('persyaratan')->where('id_periode', $id_periode)->get();
    }

    public static function getProvinsi()
    {
        return DB::table('provinces')->get();
    }

    public static function get_mhs($nim13, $fields){
		// The URL of the web service
		$url = "http://ws.usk.ac.id/webservice/pustaka/mahasiswa/cmahasiswa/mhs/npm/".$nim13."/key/lp2m23mola/";

		// Initialize curl
		$ch = curl_init();

		// Set the URL
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Execute the request and get the XML response
		$xml = curl_exec($ch);

		// Check for errors
		if (curl_errno($ch)) {
			echo "Error: " . curl_error($ch);
			exit();
		}

		// Close curl
		curl_close($ch);
		// Convert the XML data to JSON
		$simpleXml = simplexml_load_string($xml);
		$mhs = json_decode($simpleXml, true);

		// Initialize an array to store the data
        $data = [];

        // Loop through the specified fields and add them to the data array
        foreach ($fields as $field) {
            $data[$field] = (string) $simpleXml->$field;
        }

		return $data;
	}

    public static function getJumlahSKS($nim)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://krs.usk.ac.id/api/krs/jumlah-sks-kkn',
            CURLOPT_URL => 'http://10.44.0.180/api/krs/jumlah-sks-kkn',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('nim' => $nim),
            CURLOPT_HTTPHEADER => array(
                'x-token: dRgUkXp2s5v8y/B?E(G+KbPeShVmYq'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $arr = json_decode($response, true);
        $jumlah_sks = $arr["data"]["jumlah_sks"];

        return $jumlah_sks;
    }

    public static function getKabupaten($id_provinsi)
    {
        return DB::table('regencies')
            ->where('province_id', $id_provinsi)
            ->get();
    }

    public static function getKecamatan($id_kabupaten)
    {
        return DB::table('districts')
            ->where('regency_id', $id_kabupaten)
            ->get();
    }

    public static function getDesa($id_kecamatan)
    {
        return DB::table('villages')
            ->where('district_id', $id_kecamatan)
            ->get();
    }

    public static function getAllPeriode($nim, $sks)
    {
        $bulan = [
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
        ];

        $query = DB::select("
            SELECT * FROM dbkkn.periode p
            WHERE status = 1 AND min_sks <= ?
            UNION
            SELECT p.* FROM dbkkn.periode p
            LEFT JOIN whitelist b ON p.id = b.periode
            WHERE b.nim13 = ? AND b.status = 1 AND p.status = 1
            ORDER BY id DESC", [$sks, $nim]);

        foreach ($query as $data) {
            if ($data->ket != NULL) {
                $tgl = explode(" s/d ", $data->ket);
                $format_baru = [];
                $bulan2 = "";
                $tahun = "";
                for ($i = count($tgl) - 1; $i >= 0; $i--) {
                    $tgl_baru = explode(" ", $tgl[$i]);
                    if (count($tgl_baru) == 2) {
                        $tgl_str = $tgl_baru[0] . "-" . $bulan[$tgl_baru[1]] . "-" . $tahun;
                    } else if (count($tgl_baru) == 1) {
                        $tgl_str = $tgl_baru[0] . "-" . $bulan2 . "-" . $tahun;
                    } else {
                        $bulan2 = $bulan[$tgl_baru[1]];
                        $tahun = $tgl_baru[2];
                        $tgl_str = $tgl_baru[0] . "-" . $bulan[$tgl_baru[1]] . "-" . $tgl_baru[2];
                    }
                    $time = strtotime($tgl_str);
                    $format_baru[$i] = date('Y-m-d', $time);
                }

                $data->pendaftaran_ongoing = (date("Y-m-d") >= $format_baru[0]) && (date("Y-m-d") <= $format_baru[1]);
            } else {
                $data->pendaftaran_ongoing = (date("Y-m-d") >= $data->tgl_mulai_daftar) && (date("Y-m-d") <= $data->tgl_akhir_daftar);
            }

            if ($data->jenis_kkn === "" || $data->jenis_kkn === "0") {
                $data->jenis_kkn = "-";
            } else {
                $data->jenis_kkn = self::getJenisKkn($data->jenis_kkn);
            }

            $data->min_sks = $data->min_sks == 0 ? "-" : $data->min_sks;

            $data_lokasi = DB::select("SELECT * FROM dbkkn.lokasi_kkn WHERE id_periode = ?", [$data->id]);
            if($data->lokasi == "0"){
                $data->lokasi = "";
                if (count($data_lokasi) > 0) {
                    foreach ($data_lokasi as $lokasi) {
                        $data_kabupaten = DB::selectOne("
                            SELECT regencies.name AS kabupaten, provinces.name AS provinsi
                            FROM regencies, provinces
                            WHERE regencies.province_id = provinces.id AND regencies.id = ?", [$lokasi->id_kabupaten]);

                        $kabupaten = ucwords(strtolower($data_kabupaten->provinsi)) . " - " . ucwords(strtolower($data_kabupaten->kabupaten));
                        $data->lokasi .= $data->lokasi ? " # " . $kabupaten : "# " . $kabupaten;
                    }
                } else {
                    $data->lokasi = "-";
                }
            }

            if($data->nama_kkn == NULL){
                $masa_periode = $data->masa_periode;
                $nama = preg_replace("/\((.*?)\)/", "", $masa_periode);
                preg_match('/\((.*?)\)/', $masa_periode, $masa);
                $data->masa_kegiatan = $masa[1];
                $data->masa_periode = "Periode " . $nama;
            }

            $data->kuota_terisi = self::getKuotaTerisi($data->id);
            $data->kuota_status = $data->kuota_terisi < $data->kuota;

            $data->status_mhs_periode = self::cekStatusMhsPeriode($nim, $data->id);

            $semester_reg = self::getPeriodeAktif($data->id);
            $mhs_sarjana = self::cekMhsSarjana($nim);

            if ($mhs_sarjana) {
                $mhs_aktif = self::cekMhsAktif($nim, $semester_reg);
                $data->status_mhs = $mhs_aktif ? !self::cekStatusMhs($nim, $semester_reg) : false;
            } else {
                $data->status_mhs = false;
            }
        }

        return $query;
    }

    public static function getJenisKkn($id)
    {
        $sql = DB::table('jenis_kkn')->where('id', $id)->first();
        return $sql->kategori;
    }

    public static function getKuotaTerisi($id_periode)
    {
        $sql = DB::selectOne("SELECT count(*) as jumlah_peserta FROM kkn WHERE periode = ?", [$id_periode]);
        return $sql->jumlah_peserta;
    }

    public static function cekStatusMhsPeriode($nim, $periode)
    {
        $sql = DB::selectOne("SELECT * FROM kkn WHERE nim13 = ? AND periode = ?", [$nim, $periode]);
        if ($sql) {
            return $sql->status_reg == 1;
        }
        return true;
    }

    public static function getPeriodeAktif($id)
    {
        $sql = DB::selectOne("SELECT semester_reg FROM dbkkn.periode WHERE id = ?", [$id]);
        return $sql->semester_reg;
    }

    public static function cekMhsSarjana($nim13)
    {
        $kd_jenjang = substr($nim13, 4, 1);
        return $kd_jenjang == 1;
    }

    public static function cekMhsAktif($nim13, $semester)
    {
        $sql = DB::connection('puksi')->selectOne("SELECT nim13, semester FROM puksi.mhs_aktif WHERE nim13 = ? AND semester = ?", [$nim13, $semester]);
        return $sql != null;
    }

    public static function cekStatusMhs($nim13, $semester)
    {
        $sql = DB::connection('puksi')->selectOne("SELECT nim13, semester FROM puksi.status WHERE nim13 = ? AND semester = ?", [$nim13, $semester]);
        return $sql != null;
    }

    public static function getPeriode($idPeriode)
    {
        return DB::table('periode')->where('id', $idPeriode)->first();
    }

    public static function getDetailDaerah($id, $table)
    {
        if ($id) {
            $query = DB::table($table)->where('id', $id)->first();
            return ucwords(strtolower($query->name));
        } else {
            return '';
        }
    }

    public static function getDataPeriode($id)
    {
        return DB::table('dbkkn.periode')
            ->select('id', 'jenis_kkn')
            ->where('id', $id)
            ->first();
    }

    public static function insertData($table, array $data)
    {
        try {
            DB::table($table)->insert($data);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
