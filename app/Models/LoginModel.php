<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class LoginModel extends Model
{
    use HasFactory;

    // protected static $key = 'd4ftar_u5k';

    // public function loginByWs($nip, $password)
    // {
    //     $url = 'http://ws.usk.ac.id/webservice/dosen/cdosen/login/nip/' . $nip . '/key' . '/' . self::$key;

    //     $ch = curl_init($url);

    //     curl_setopt_array($ch, array(
    //         CURLOPT_URL => $url,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_SSL_VERIFYHOST => 0,
    //         CURLOPT_SSL_VERIFYPEER => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         // CURLOPT_POST => 1,
    //         //accept application/xml
    //         CURLOPT_HTTPHEADER => array(
    //             'Accept: application/xml'
    //         ),
    //     ));

    //     $result = curl_exec($ch);
    //     curl_close($ch);
    //     $data = simplexml_load_string($result);

    //     // convert password md5
    //     $passwordConvert = md5($password);

    //     if ($passwordConvert === (string) $data->md5) {
    //         return true;
    //     }

    //     return false;
    // }

    // public static function loginMahasiswa($nim, $password)
    // {
    //     $url = 'http://ws.usk.ac.id/webservice/mahasiswa/cmahasiswa/login';

    //     $data = [
    //         'nim' => $nim,
    //         'password' => $password
    //     ];

    //     // Lakukan request ke Web Service dengan HTTP Client Laravel
    //     $response = Http::asForm()->post($url, $data);

    //     // Handle response
    //     if ($response->successful()) {
    //         $result = self::parseXmlResponse($response->body());
    //         if ($result && isset($result->status_info_login) && $result->status_info_login == 2) {
    //             return true; // Login berhasil
    //         }
    //     }

    //     return false; // Login gagal
    // }

    public static function loginStaf($nip, $password)
    {
        $url = 'http://ws.usk.ac.id/webservice/mahasiswa/cmahasiswa/login';

        $data = [
            'nip' => $nip,
            'password' => $password
        ];

        // Lakukan request ke Web Service dengan HTTP Client Laravel
        $response = Http::asForm()->post($url, $data);

        // Handle response
        if ($response->successful()) {
            $result = self::parseXmlResponse($response->body());
            if ($result && isset($result->status_info_login) && $result->status_info_login == 2) {
                return true; // Login berhasil
            }
        }

        return false; // Login gagal
    }

    // Fungsi untuk mem-parsing response XML
    private static function parseXmlResponse($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        $data = json_decode($json);
        return $data;
    }

    public function getAkun($nip)
    {
        $url = 'http://ws.usk.ac.id/webservice/dosen/cdosen/login/nip/' . $nip . '/key' . '/' . self::$key;

        $ch = curl_init($url);

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            // CURLOPT_POST => 1,
            //accept application/xml
            CURLOPT_HTTPHEADER => array(
                'Accept: application/xml'
            ),
        ));

        $result = curl_exec($ch);
        if ($result === false) {
            // Handle cURL error
            $error = curl_error($ch);
            curl_close($ch);
            return "cURL Error: " . $error;
        }

        curl_close($ch);

        $data = simplexml_load_string($result);
        if ($data === false) {
            return "Failed to parse XML response";
        }

        // Convert SimpleXMLElement to array directly
        $dataArray = json_decode(json_encode($data), true);

        return $dataArray;
    }
}
