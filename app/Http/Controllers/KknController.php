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
        return view('panitia.dashboard', compact('kkns'));
    }

    public function berkas(Request $request)
    {
        $nip = $request->session()->get('nip');
        return view('panitia.berkas', compact('nip'));
    }

    public function jenis_kkn(Request $request)
    {
        $nip = $request->session()->get('nip');
        $jenis_kkns = JenisKkn::all();
        return view('panitia.jenis-kkn', compact('jenis_kkns', 'nip'));
    }

    public function create(Request $request)
    {
        $nip = $request->session()->get('nip');
        $jenis_kkns = JenisKkn::all();
        return view('panitia.kkn-baru', compact('jenis_kkns', 'nip'));
    }

    public function buat()
    {
        $jenis_kkns = JenisKkn::all();
        // return view('panitia.kkn', compact('jenis_kkns'));
        // return view('panitia.kkn-edit', compact('jenis_kkns'));
    }

    public function store(Request $request)
    {
        // return redirect()->back()->with("pesan", "controller oke");
        $messages = [
            'required' => 'Kolom ini wajib diisi.',
            'max' => 'Kolom ini tidak boleh lebih dari :max karakter.',
            'numeric' => 'Kolom ini harus berisi angka.',
        ];

        // Validasi input
        // $request->validate([
        //     'jenis_kkn' => 'required',
        //     // 'masa_pendaftaran' => 'required|string|max:255',
        //     // 'tahun_ajaran' => 'required|string|max:255',
        //     // 'semester' => 'required|string|max:255',
        //     'kode_kkn' => 'required|string|max:255',
        //     'min_sks' => 'required|numeric',
        //     'kuota' => 'required|numeric',
        // ], $messages);

        // Simpan data KKN baru
        $periode = new Periode();
        // $periode->masa_periode = $request->masa_periode;
        $periode->jenis_kkn = $request->jenis_kkn;
        // $periode->masa_pendaftaran = $request->masa_pendaftaran;
        // $periode->tahun_ajaran = $request->tahun_ajaran;
        // $periode->semester = $request->semester;
        $periode->kode = $request->kode_kkn;
        $periode->min_sks = $request->min_sks;
        $periode->status = 1;
        $periode->kuota = $request->kuota;
        $periode->min_sks = $request->min_sks;
        $periode->lokasi = 0;

        // dd($periode);
        $periode->save();

        // dd($periode);

        // Redirect dengan pesan sukses
        return redirect('/dashboard')->with('success', 'KKN baru berhasil dibuat.');
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
