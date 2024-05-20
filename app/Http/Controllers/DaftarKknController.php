<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Kkn;
use App\Models\Periode;
use App\Models\JenisKkn;
use App\Models\Provinsi;
use App\Models\DaftarModel;
use Illuminate\Http\Request;

class DaftarKknController extends Controller
{
    public function index(Request $request)
    {
        $nim = $request->session()->get('nim');

        $jumlah_sks = DaftarModel::getJumlahSKS($nim);
        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);

        $kkns = Periode::where('status', '1')->orderBy('id', 'desc')->get();
        return view('mahasiswa.beranda', compact('kkns', 'jumlah_sks', 'mahasiswa'));
    }

    public function jenis_kkn()
    {
        $jenis_kkns = JenisKkn::all();
        return view('jenis-kkn', compact('jenis_kkns'));
    }

    public function daftar($id)
    {
        $nim = session()->get('nim');

        $fields = ['npm', 'nama', 'tempat_lahir', 'tanggal_lahir', 'email', 'alamat', 'no_tlp_mhs', 'jenis_kelamin'];
        $jumlah_sks = DaftarModel::getJumlahSKS($nim);

        $mahasiswa = DaftarModel::get_mhs($nim, $fields);

        // Konversi 'tanggal_lahir' menjadi objek tanggal menggunakan Carbon
        if ($mahasiswa && $mahasiswa['tanggal_lahir']) {
            $mahasiswa['tanggal_lahir'] = Carbon::parse($mahasiswa['tanggal_lahir'])->format('Y-m-d');
        }

        $provinsi = Provinsi::all();
        $periodeId = $id;

        return view('mahasiswa.daftar-kkn', compact('mahasiswa', 'jumlah_sks', 'provinsi', 'periodeId'));
    }

    public function buat()
    {
        $jenis_kkns = JenisKkn::all();
        // return view('panitia.kkn', compact('jenis_kkns'));
        // return view('panitia.kkn-edit', compact('jenis_kkns'));
    }

    public function submit_registrasi(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'nama' => 'required|string',
        //     'nim' => 'required|numeric',
        //     'nik' => 'required|numeric',
        //     'tmp_lahir' => 'required|string',
        //     'tgl_lahir' => 'required|string',
        //     'jenis_kelamin' => 'required|string',
        //     'sks' => 'required|numeric',
        //     'email' => 'required|email',
        //     'no_hp' => 'required|numeric',
        //     'agama' => 'required|string',
        //     'bpjs' => 'required|string',
        //     'status' => 'required|string',
        //     'warga' => 'required|string',
        //     'provinsi' => 'required|string',
        //     'kabupaten' => 'required|string',
        //     'kecamatan' => 'required|string',
        //     'alamat_lengkap' => 'required|string',
        // ]);

        // Simpan data KKN baru
        $kkn = new Kkn();
        $kkn->periode = $request->periode;
        $kkn->nama_mhs = $request->nama;
        $kkn->nim13 = $request->nim;
        $kkn->nik_indonesia = $request->nik;
        $kkn->tempat_lahir = $request->tmp_lahir;
        $kkn->tgl_lahir = $request->tgl_lahir;
        $kkn->jenis_kelamin = $request->jenis_kelamin;
        $kkn->jum_sks = $request->sks;
        $kkn->penyakit = $request->penyakit;
        $kkn->informasi_lainnya = $request->informasi_lainnya;
        $kkn->agama = $request->agama;
        $kkn->status_sipil = $request->status;
        $kkn->no_telp_mhs = $request->no_hp;
        $kkn->no_telp_ayah = $request->no_hp_ayah;
        $kkn->no_telp_ibu = $request->no_hp_ibu;
        $kkn->no_telp_wali = $request->no_hp_wali;
        $kkn->bpjs = $request->bpjs;
        $kkn->ayah = $request->ayah;
        $kkn->ibu = $request->ibu;
        $kkn->wali = $request->wali;
        $kkn->talenta = $request->talenta;
        $kkn->kewarganegaraan = $request->kewarganegaraan;
        $kkn->negara_asing = $request->negara_asing;
        $kkn->kelompok = "";
        $kkn->id_lokasi = 0;
        $kkn->status_reg = 1;
        $kkn->ip_reg = '10.44.0.49';
        $kkn->jenis_kkn = 1;

        // dd($kkn);
        $kkn->save();

        // Redirect dengan pesan sukses
        return redirect('/beranda')->with('success', 'KKN berhasil didaftarkan.');
    }

    // public function submit_registrasi(Request $request)
    // {
    //     $data = $request;

    //     // $id_periode = $data['id_periode'];
    //     // $kuota_terisi = DB::table('daftar')->where('id_periode', $id_periode)->count();
    //     // $data_periode = DB::table('periode')->where('id', $id_periode)->first();
    //     // $kuota = $data_periode->kuota;

    //     // if ($kuota_terisi >= $kuota) {
    //     //     return response()->json(['status' => false, 'message' => "Kuota Sudah Penuh"]);
    //     // }

    //     // $jumlah_sks = DB::table('mahasiswa')->where('username', auth()->user()->username)->value('sks');
    //     // $min_sks_periode = $data_periode->min_sks;

    //     // Handle upload files
    //     // $nama_berkas_izin = $request->file('berkas_izin')->store('berkas_izin');
    //     // $nama_berkas_dokter = $request->file('berkas_dokter')->store('berkas_dokter');

    //     // $alamat_lengkap = $data['alamat_lengkap'] . ', ' .
    //     //     $this->getKecamatan($data['kecamatan'], 'districts') . ', ' .
    //     //     $this->getKabupaten($data['kabupaten'], 'regencies') . ', ' .
    //         // $this->getDetailDaerah($data['provinsi'], 'provinces');

    //     // Insert into database
    //     $result = DB::table('kkn')->insert([
    //         'nim13' => $data['nim'],
    //         'nama_mhs' => $data['nama'],
    //         'tempat_lahir' => $data['tmp_lahir'],
    //         'tgl_lahir' => $data['tgl_lahir'],
    //         'jenis_kelamin' => $data['jenis_kelamin'],
    //         'periode' => $data['id_periode'],
    //         'jum_sks' => $data['sks'],
    //         'penyakit' => $data['penyakit'] ?? "-",
    //         'informasi_lainnya' => $data['informasi_lainnya'] ?? "Tidak",
    //         'jenis_disabilitas' => $data['jenis_disabilitas'] ?? "-",
    //         'nik_indonesia' => $data['nik'],
    //         'email' => $data['email'],
    //         'npwp' => $data['npwp'] ?? "-",
    //         'nama_bank' => $data['nama_bank'] ?? "-",
    //         'no_rek' => $data['no_rek'] ?? "-",
    //         'agama' => $data['agama'],
    //         'status_sipil' => $data['status'],
    //         'no_telp_mhs' => $data['no_hp'],
    //         // 'alamat_mhs' => $alamat_lengkap,
    //         // 'berkas_izin_orang_tua' => $nama_berkas_izin,
    //         // 'berkas' => $nama_berkas_dokter,
    //         'ip_reg' => $data['ip_address'],
    //         'id_kabupaten' => $data['kabupaten'],
    //     ]);

    //     if ($result) {
    //         return response()->json(['status' => true, 'message' => "Berhasil mendaftar"]);
    //     }

    //     return response()->json(['status' => false, 'message' => "Terjadi kesalahan saat mendaftar"]);
    // }

    public function edit($id)
    {
        $kkns = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();
        return view('panitia.kkn-edit', compact('kkns', 'jenis_kkns'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'harga' => 'required|numeric|digits_between:1,6',
            'stok' => 'required|numeric',
            'jumlah_per_satuan' => 'numeric',
            // 'gambar' => 'required|max:5000'
        ]);

        $kkns = Periode::findOrFail($id);

        $kkns->update([
            "nama" => $request->nama,
            'promo_id' => $request->promo_id,
            "harga" => $request->harga,
            "stok" => $request->stok,
            "satuan" => $request->satuan,
            "jumlah_per_satuan" => $request->jumlah_per_satuan,
            "harga_promo" => $request->harga_promo,
            "keterangan" => $request->keterangan,
            // "gambar" => asset('/gambar' . $kkns->gambar),
        ]);

        $kkns->save();

        return redirect('/dashboard')->with('sukses', 'Data berhasil diupdate');
    }

    public function add_jenis_kkn(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string',
        ]);

        // Simpan data KKN baru
        $jenis_kkn = new JenisKkn();
        $jenis_kkn->kategori = $request->kategori;
        $jenis_kkn->save();

        // Redirect dengan pesan sukses
        return redirect()->route('jenis.kkn')->with('success', 'Kategori KKN baru berhasil ditambahkan.');
    }

    public function getKabupaten(Request $request)
    {
        $id_provinsi = $request->post('id_provinsi');
        $data_kabupaten = DaftarModel::getKabupaten($id_provinsi);
        $data_row = array();

        foreach ($data_kabupaten as $data) {
            $data_column = array();
            $data_column['id'] = $data->id;
            $data_column['kabupaten'] = ucwords(strtolower($data->name));
            $data_row[] = $data_column;
        }

        return response()->json($data_row);
    }

    public function getKecamatan(Request $request)
    {
        $id_kabupaten = $request->post('id_kabupaten');
        $data_kecamatan = DaftarModel::getKecamatan($id_kabupaten);
        $data_row = array();

        foreach ($data_kecamatan as $data) {
            $data_column = array();
            $data_column['id'] = $data->id;
            $data_column['kecamatan'] = ucwords(strtolower($data->name));
            $data_row[] = $data_column;
        }

        return response()->json($data_row);
    }
}
