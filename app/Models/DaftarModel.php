<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarModel extends Model
{
    use HasFactory;

    // protected static $key = 'd4ftar_u5k';

    public function get_mhs($nim13, $field){
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
		$data = (string) $simpleXml->$field;

		return $data;
	}
}
