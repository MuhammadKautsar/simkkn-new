<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Periode;
use App\Models\JenisKkn;
use App\Models\Provinsi;
use App\Models\DaftarModel;
use Illuminate\Http\Request;

class DaftarKknController extends Controller
{
    public function index()
    {
        $kkns = Periode::orderBy('id', 'desc')->paginate(10);
        return view('dashboard', compact('kkns'));
    }

    public function jenis_kkn()
    {
        $jenis_kkns = JenisKkn::all();
        return view('jenis-kkn', compact('jenis_kkns'));
    }

    public function daftar(Request $request)
    {
        $nim = $request->session()->get('nim');

        $fields = ['npm', 'nama', 'tempat_lahir', 'tanggal_lahir', 'email', 'alamat', 'no_tlp_mhs', 'jenis_kelamin'];
        $jumlah_sks = DaftarModel::getJumlahSKS($nim);

        $mahasiswa = DaftarModel::get_mhs($nim, $fields);

        $provinsi = Provinsi::all();

        return view('mahasiswa.daftar-kkn', compact('mahasiswa', 'jumlah_sks', 'provinsi'));
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
        $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|numeric',
            'nik' => 'required|numeric',
            'tmp_lahir' => 'required|string',
            'tgl_lahir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'sks' => 'required|numeric',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'agama' => 'required|string',
            'bpjs' => 'required|string',
            'status' => 'required|string',
            'warga' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'alamat_lengkap' => 'required|string',
        ]);

        // Simpan data KKN baru
        $kkn = new Kkn();
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
        $kkn->no_telp_ayah = $request->no_telp_ayah;
        $kkn->no_telp_ibu = $request->no_telp_ibu;
        $kkn->no_telp_wali = $request->no_telp_wali;
        $kkn->bpjs = $request->bpjs;
        $kkn->ayah = $request->ayah;
        $kkn->ibu = $request->ibu;
        $kkn->wali = $request->wali;
        $kkn->talenta = $request->talenta;
        $kkn->kewarganegaraan = $request->kewarganegaraan;
        $kkn->negara_asing = $request->negara_asing;
        $kkn->save();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'KKN berhasil didaftarkan.');
    }

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
