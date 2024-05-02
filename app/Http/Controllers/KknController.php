<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Periode;
use App\Models\JenisKkn;
use Illuminate\Http\Request;

class KknController extends Controller
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

    public function create()
    {
        $jenis_kkns = JenisKkn::all();
        return view('panitia.kkn-baru', compact('jenis_kkns'));
    }

    public function buat()
    {
        $jenis_kkns = JenisKkn::all();
        // return view('panitia.kkn', compact('jenis_kkns'));
        // return view('panitia.kkn-edit', compact('jenis_kkns'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kkn' => 'required|string|max:255',
            'masa_kegiatan' => 'required|string|max:255',
            'jenis_kkn' => 'required',
            'masa_pendaftaran' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'kode_kkn' => 'required|string|max:255',
            'minimal_sks' => 'required|numeric',
            'kuota_peserta' => 'required|numeric',
        ]);

        // Simpan data KKN baru
        $kkn = new Kkn();
        $kkn->nama_kkn = $request->nama_kkn;
        $kkn->masa_kegiatan = $request->masa_kegiatan;
        $kkn->jenis_kkn = $request->jenis_kkn;
        $kkn->masa_pendaftaran = $request->masa_pendaftaran;
        $kkn->tahun_ajaran = $request->tahun_ajaran;
        $kkn->semester = $request->semester;
        $kkn->kode_kkn = $request->kode_kkn;
        $kkn->minimal_sks = $request->minimal_sks;
        $kkn->kuota_peserta = $request->kuota_peserta;
        $kkn->save();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'KKN baru berhasil ditambahkan.');
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

        if ($request->hasFile("gambar")) {
            $files = $request->file("gambar");
            foreach ($files as $file) {
                $imageName = time() . "_" . $file->getClientOriginalName();
                $request["kkns_id"] = $id;
                $request["path_image"] = asset('uploads/' . $imageName);
                $file->move($this->path_file("/uploads"), $imageName);
                Image::create($request->all());
            }
        }
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
}
