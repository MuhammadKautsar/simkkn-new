<?php

namespace App\Http\Controllers;

use App\Models\BatasanWaktu;
use App\Models\Dosen;
use App\Models\Kkn;
use App\Models\Periode;
use App\Models\JenisKkn;
use App\Models\MasterDesa;
use App\Models\PanitiaModel;
use Illuminate\Http\Request;
use DB;

class KknController extends Controller
{
    public function index()
    {
        $kkns = Periode::orderBy('id', 'desc')->paginate(10);
        return view('panitia.dashboard', compact('kkns'));
    }

    public function berkas(Request $request)
    {
        $nip = session()->get('nip');
        return view('panitia.berkas', compact('nip'));
    }

    public function jenis_kkn(Request $request)
    {
        $nip = session()->get('nip');
        $jenis_kkns = JenisKkn::all();
        return view('panitia.jenis-kkn', compact('jenis_kkns', 'nip'));
    }

    public function create(Request $request)
    {
        $nip = session()->get('nip');
        $jenis_kkns = JenisKkn::all();
        return view('panitia.kkn-baru', compact('jenis_kkns', 'nip'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom ini wajib diisi.',
            'max' => 'Kolom ini tidak boleh lebih dari :max karakter.',
            'numeric' => 'Kolom ini harus berisi angka.',
        ];

        // Validasi input
        $request->validate([
            'jenis_kkn' => 'required',
            'masa_periode' => 'required|string',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'kode_kkn' => 'required|string',
            'min_sks' => 'required|numeric',
            'kuota' => 'required|numeric',
        ], $messages);

        // Simpan data KKN baru
        $periode = new Periode();
        $periode->nama_kkn = $request->nama_kkn;
        $periode->masa_periode = $request->masa_periode;
        $periode->jenis_kkn = $request->jenis_kkn;
        $periode->kode = $request->kode_kkn;
        $periode->tahun_ajaran = $request->tahun_ajaran;
        $tahun_ajaran = explode('/',  $request->tahun_ajaran);
        $periode->semester_reg = $tahun_ajaran[0].$request->semester;
        $periode->tgl_mulai_daftar = $request->tgl_mulai_daftar;
        $periode->tgl_akhir_daftar = $request->tgl_akhir_daftar;
        $periode->min_sks = $request->min_sks;
        $periode->status = 1;
        $periode->kuota = $request->kuota;
        $periode->lokasi = 0;

        $periode->save();

        // Redirect dengan pesan sukses
        return redirect('/dashboard')->with('success', 'KKN baru berhasil dibuat.');
    }

    public function edit($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();
        $persyaratan = PanitiaModel::getPersyaratan($id);

        return view('panitia.kkn-edit', compact('kkn', 'jenis_kkns', 'nip', 'persyaratan'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom ini wajib diisi.',
            'max' => 'Kolom ini tidak boleh lebih dari :max karakter.',
            'numeric' => 'Kolom ini harus berisi angka.',
        ];

        // Validasi input
        $request->validate([
            'jenis_kkn' => 'required',
            'masa_periode' => 'required|string',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'kode_kkn' => 'required|string',
            'min_sks' => 'required|numeric',
            'kuota' => 'required|numeric',
        ], $messages);

        $periode = Periode::findOrFail($id);

        $periode->update([
            'nama_kkn' => $request->nama_kkn,
            'masa_periode' => $request->masa_periode,
            'jenis_kkn' => $request->jenis_kkn,
            'kode' => $request->kode_kkn,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester_reg' => explode('/', $request->tahun_ajaran)[0] . $request->semester,
            'tgl_mulai_daftar' => $request->tgl_mulai_daftar,
            'tgl_akhir_daftar' => $request->tgl_akhir_daftar,
            'min_sks' => $request->min_sks,
            'status' => 1,
            'kuota' => $request->kuota,
            'lokasi' => 0
        ]);

        return redirect()->back()->with('sukses', 'Data berhasil diupdate');
    }

    public function tambahPersyaratan(Request $request)
    {
        $validatedData = $request->validate([
            'id_periode' => 'required|integer',
            'nama_persyaratan' => 'required|string|max:255',
        ]);

        DB::table('persyaratan')->insert([
            'id_periode' => $validatedData['id_periode'],
            'nama_persyaratan' => $validatedData['nama_persyaratan'],
        ]);

        return redirect()->back()->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function hapusPersyaratan($id)
    {
        $persyaratan = DB::table('persyaratan')->where('id', $id)->delete();
        if ($persyaratan) {
            return redirect()->back()->with('success', 'Persyaratan berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Persyaratan tidak ditemukan.');
    }

    public function konfigurasi_dosen($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();

        // Menggunakan metode query mentah
        // $dosen = $this->getDosen($id);

        // Atau menggunakan metode Eloquent
        $perPage = 10;
        $dosen = Dosen::getDosen($id, $perPage);

        return view('panitia.konfigurasi-dosen', compact('kkn', 'dosen', 'jenis_kkns', 'nip'));
    }

    public function konfigurasi_lokasi($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();
        $desa = $kkn->masterDesas()->whereNotNull('nama_desa')->paginate(10);
        return view('panitia.konfigurasi-lokasi', compact('kkn', 'jenis_kkns', 'nip', 'desa'));
    }

    public function konfigurasi_peserta($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();

        // Menghitung jumlah peserta berdasarkan id periode dan status_reg = 1
        $jumlah_peserta = Kkn::where('periode', $id)
        ->where('status_reg', 1)
        ->count();

        // Menghitung jumlah peserta laki-laki
        $peserta_laki = Kkn::where('periode', $id)
        ->where('jenis_kelamin', 'Laki-laki')
        ->count();

        // Menghitung jumlah peserta perempuan
        $peserta_perempuan = Kkn::where('periode', $id)
        ->where('jenis_kelamin', 'Perempuan')
        ->count();

        // Menghitung jumlah prodi yang mendaftar berdasarkan kolom kd_fjjp7 (unik)
        $total_prodi = Kkn::where('periode', $id)
        ->distinct('kd_fjjp7')
        ->count('kd_fjjp7');

        $peserta = Kkn::where('periode', $id)->orderBy('status_reg', 'asc')->paginate(25);
        return view('panitia.konfigurasi-peserta', compact('kkn', 'jenis_kkns', 'nip', 'peserta', 'jumlah_peserta', 'peserta_laki', 'peserta_perempuan', 'total_prodi'));
    }

    public function konfigurasi_bataswaktu($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);

        $batasanWaktu = $kkn->getBatasanWaktu();
        return view('panitia.konfigurasi-bataswaktu', compact('kkn', 'nip', 'batasanWaktu'));
    }

    public function setBatasWaktuDosen(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|integer',
            'mulai_laporan_survey' => 'required|date',
            'akhir_laporan_survey' => 'required|date',
            'mulai_monev' => 'required|date',
            'akhir_monev' => 'required|date',
            'mulai_upload_nilai' => 'required|date',
            'akhir_upload_nilai' => 'required|date',
        ]);

        $id_periode = $request->input('id_periode');
        $data = $request->only([
            'mulai_laporan_survey', 'akhir_laporan_survey',
            'mulai_monev', 'akhir_monev',
            'mulai_upload_nilai', 'akhir_upload_nilai'
        ]);

        $periode = Periode::findOrFail($id_periode);

        if (!$periode->batasan_waktu) {
            $batasanWaktu = BatasanWaktu::create($data);
            $periode->batasan_waktu = $batasanWaktu->id;
            $periode->save();
        } else {
            $batasanWaktu = BatasanWaktu::findOrFail($periode->batasan_waktu);
            $batasanWaktu->update($data);
        }

        return redirect()->back()->with('success', 'Data batasan waktu dosen berhasil disimpan.');
    }

    public function setBatasWaktuMahasiswa(Request $request)
    {
        $request->validate([
            'id_periode_mhs' => 'required|integer',
            'mulai_upload_proposal' => 'required|date',
            'akhir_upload_proposal' => 'required|date',
            'mulai_logbook_1' => 'required|date',
            'akhir_logbook_1' => 'required|date',
            'mulai_logbook_2' => 'required|date',
            'akhir_logbook_2' => 'required|date',
            'mulai_logbook_3' => 'required|date',
            'akhir_logbook_3' => 'required|date',
            'mulai_logbook_4' => 'required|date',
            'akhir_logbook_4' => 'required|date',
            'mulai_laporan_akhir' => 'required|date',
            'akhir_laporan_akhir' => 'required|date',
        ]);

        $id_periode = $request->input('id_periode_mhs');
        $data = $request->only([
            'mulai_upload_proposal', 'akhir_upload_proposal',
            'mulai_logbook_1', 'akhir_logbook_1',
            'mulai_logbook_2', 'akhir_logbook_2',
            'mulai_logbook_3', 'akhir_logbook_3',
            'mulai_logbook_4', 'akhir_logbook_4',
            'mulai_laporan_akhir', 'akhir_laporan_akhir'
        ]);

        $periode = Periode::findOrFail($id_periode);

        if (!$periode->batasan_waktu) {
            $batasanWaktu = BatasanWaktu::create($data);
            $periode->batasan_waktu = $batasanWaktu->id;
            $periode->save();
        } else {
            $batasanWaktu = BatasanWaktu::findOrFail($periode->batasan_waktu);
            $batasanWaktu->update($data);
        }

        return redirect()->back()->with('success', 'Data batasan waktu mahasiswa berhasil disimpan.');
    }

    // public function konfigurasi_monitoring($id, $idPeriode = null)
    public function konfigurasi_monitoring($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);

        // $dataPeriode = $idPeriode;
        // $jenisKkn = Periode::find($idPeriode)->jenis_kkn;
        // $status = Periode::find($idPeriode)->status;
        // $dataMahasiswa = $this->getMahasiswa($idPeriode); // Anda perlu mengimplementasikan metode ini
        // $dataMahasiswaLuarUsk = $this->getMahasiswaLuar($idPeriode); // Anda perlu mengimplementasikan metode ini
        // $dataDosen = $this->getKelompok($idPeriode);

        $dataPeriode = $id;
        $jenisKkn = Periode::find($id)->jenis_kkn;
        $status = Periode::find($id)->status;
        $dataMahasiswa = $this->getMahasiswa($id); // Anda perlu mengimplementasikan metode ini
        $dataMahasiswaLuarUsk = $this->getMahasiswaLuar($id); // Anda perlu mengimplementasikan metode ini
        $dataDosen = $this->getKelompok($id);

        return view('panitia.konfigurasi-monitoring', compact('nip', 'kkn', 'dataPeriode', 'jenisKkn', 'status', 'dataMahasiswa', 'dataMahasiswaLuarUsk', 'dataDosen'));
    }

    private function getKelompok($idPeriode)
    {
        $dataDosen = MasterDesa::where('periode', $idPeriode)
            ->whereNotNull('kd_kelompok')
            ->where('kd_kelompok', '<>', '')
            ->orderBy('kd_kecamatan')
            // ->get();
            ->paginate(25);

        foreach ($dataDosen as $data) {
            $data->nama_dpl = $data->nip_dpl ? $this->getNamaDosen($data->nip_dpl, $idPeriode) : "";
        }

        return $dataDosen;
    }

    private function getNamaDosen($nipDpl, $idPeriode)
    {
        // Implementasikan logika untuk mendapatkan nama dosen
        return "Nama Dosen"; // Ganti dengan logika yang sesuai
    }

    private function getMahasiswa($idPeriode)
    {
        $dataMhs = Kkn::select(
                'kkn.*',
                'f.nama_fakultas as fakultas',
                'p.nama_prodi as prodi',
                'm.proposal_kkn',
                'm.penetapan_kkn',
                'm.laporan_kkn',
                \DB::raw("IF(kkn.nim13 = m.nim_ketua, 'Ketua', 'Anggota') as status_keanggotaan"),
                'm.nama_desa',
                'm.nama_kecamatan',
                'd.nama as nama_dpl',
                'l.logbook_1',
                'l.logbook_2',
                'l.logbook_3',
                'l.logbook_4',
                'l.youtube_1',
                'l.youtube_2',
                'l.youtube_3',
                'l.youtube_4',
                'r.name as kabupaten_domisili',
                'v.name as provinsi_domisili',
                \DB::raw("concat(substring(m.kd_kelompok, 1, length(pr.kode)), lpad(substring(m.kd_kelompok, length(pr.kode)+1), 3, '0')) as kd_kelompok")
            )
            ->leftJoin('prodi as p', \DB::raw('substring(kkn.nim13, 3, 7)'), '=', 'p.kd_fjjp7')
            ->leftJoin('fakultas as f', 'f.kd_fakultas2', '=', 'kkn.kd_fakultas')
            ->leftJoin('master_desa as m', 'kkn.kelompok', '=', 'm.id')
            ->leftJoin('dosen as d', function($join) {
                $join->on('m.nip_dpl', '=', 'd.nip')
                     ->on('d.id_periode', '=', 'kkn.periode');
            })
            ->leftJoin('logbook as l', 'kkn.logbook', '=', 'l.id')
            ->leftJoin('regencies as r', 'r.id', '=', 'kkn.id_kabupaten')
            ->leftJoin('provinces as v', 'v.id', '=', 'r.province_id')
            ->leftJoin('periode as pr', 'pr.id', '=', 'kkn.periode')
            ->where('kkn.periode', $idPeriode)
            // ->get();
            ->paginate(25);

        foreach ($dataMhs as $data) {
            if (empty($data->kelompok) || $data->kelompok === "X") {
                $data->kd_kelompok = "Belum ada kelompok";
                $data->kabupaten_penempatan = "";
            } else {
                if ($data->kelompok !== "Nonaktif") {
                    $lokasi = MasterDesa::join('regencies', 'regencies.id', '=', 'master_desa.kd_kabkota')
                        ->where('master_desa.id', $data->kelompok)
                        ->first();
                    $data->kabupaten_penempatan = $lokasi ? $lokasi->name : "";
                }
            }

            if ($data->status_reg === "0") {
                $data->kd_kelompok = "Nonaktif";
            }

            $data->link_1 = explode("; ", $data->youtube_1);
            $data->link_2 = explode("; ", $data->youtube_2);
            $data->link_3 = explode("; ", $data->youtube_3);
            $data->link_4 = explode("; ", $data->youtube_4);
        }

        return $dataMhs;
    }

    private function getMahasiswaLuar($idPeriode)
    {
        // Implementasikan metode ini sesuai kebutuhan Anda
    }

    public function konfigurasi_nilaiakhir($id)
    {
        $nip = session()->get('nip');
        $kkn = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();

        $nilai = PanitiaModel::getNilaiAll($id);
        return view('panitia.konfigurasi-nilaiakhir', compact('kkn', 'jenis_kkns', 'nip', 'nilai'));
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

    public function kknSelesai(Request $request)
    {
        $id_periode = $request->input('id_periode');
        $data = ['status' => 0];

        $hasil = PanitiaModel::updateData($id_periode, 'periode', $data);

        if ($hasil !== "failed") {
            return response()->json("Status periode telah diubah");
        } else {
            return response()->json("Terjadi kesalahan");
        }
    }

    public function kknNonaktif(Request $request)
    {
        $id_periode = $request->input('id_periode');
        $data = ['status' => 2];

        $hasil = PanitiaModel::updateData($id_periode, 'periode', $data);

        if ($hasil !== "failed") {
            return response()->json("Status periode telah diubah");
        } else {
            return response()->json("Terjadi kesalahan");
        }
    }

    // public function ambilPersyaratan(Request $request)
    // {
    //     $id_periode = $request->input('id_periode');
    //     $data = PanitiaModel::getPersyaratan($id_periode);
    //     return response()->json($data);
    // }
}
