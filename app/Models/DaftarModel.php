<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;

class DaftarModel extends Model
{
    use HasFactory;

    // protected static $key = 'd4ftar_u5k';

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
}
