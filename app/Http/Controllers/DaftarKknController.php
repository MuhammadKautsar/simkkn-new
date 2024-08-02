<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\JenisKkn;
use App\Models\Provinsi;
use App\Models\DaftarModel;
use Illuminate\Http\Request;

class DaftarKknController extends Controller
{
    public function index()
    {
        $nim = session()->get('nim');

        $jumlah_sks = DaftarModel::getJumlahSKS($nim);
        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);

        $periode = DaftarModel::getAllPeriode($nim, $jumlah_sks);

        return view('mahasiswa.beranda', compact('jumlah_sks', 'periode', 'mahasiswa'));
    }

    public function jenis_kkn()
    {
        $jenis_kkns = JenisKkn::all();
        return view('jenis-kkn', compact('jenis_kkns'));
    }

    public function daftar($id)
    {
        $nim = session()->get('nim');

        $jumlah_sks = DaftarModel::getJumlahSKS($nim);

        $mahasiswa = DaftarModel::getMhs($nim);

        $provinsi = Provinsi::all();
        $periodeId = $id;
        $syarat = DaftarModel::getPersyaratan($id);

        return view('mahasiswa.daftar-kkn', compact('mahasiswa', 'jumlah_sks', 'provinsi', 'periodeId', 'syarat'));
    }

    public function submit_registrasi(Request $request)
    {
        $nim = session()->get('nim');

        // Validation rules
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'alamat_lengkap' => 'required',
            'no_hp' => 'required',
            'sks' => 'required',
            'agama' => 'required',
            'id_periode' => 'required',
            'ip_address' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'nik' => 'required',
            'email' => 'required',
            'informasi_lainnya' => 'required',
        ], [
            'required' => ':attribute Harus diisi'
        ]);

        $id_periode = $request->input('id_periode');
        $kuota_terisi = DaftarModel::getKuotaTerisi($id_periode);
        $dataa_periode = DaftarModel::getPeriode($id_periode);
        // $kuota = $dataa_periode['kuota'];
        $kuota = $dataa_periode->kuota;

        if ($kuota_terisi >= $kuota) {
            return response()->json([
                'status' => false,
                'message' => 'Kuota Sudah Penuh'
            ]);
        } else {
            $jumlah_sks = DaftarModel::getJumlahSKS($nim);
            // $min_sks_periode = $dataa_periode['min_sks'];
            $min_sks_periode = $dataa_periode->min_sks;

            $alamat_lengkap = $request->input('alamat_lengkap') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kecamatan'), 'districts') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kabupaten'), 'regencies') . ', ' .
                DaftarModel::getDetailDaerah($request->input('provinsi'), 'provinces');

            // Additional address details for ayah, ibu, and wali
            $alamat_ayah = $request->input('alamat_lengkap_ayah') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kecamatan_ayah'), 'districts') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kabupaten_ayah'), 'regencies') . ', ' .
                DaftarModel::getDetailDaerah($request->input('provinsi_ayah'), 'provinces');

            $alamat_ibu = $request->input('alamat_lengkap_ibu') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kecamatan_ibu'), 'districts') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kabupaten_ibu'), 'regencies') . ', ' .
                DaftarModel::getDetailDaerah($request->input('provinsi_ibu'), 'provinces');

            $alamat_wali = $request->input('alamat_lengkap_wali') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kecamatan_wali'), 'districts') . ', ' .
                DaftarModel::getDetailDaerah($request->input('kabupaten_wali'), 'regencies') . ', ' .
                DaftarModel::getDetailDaerah($request->input('provinsi_wali'), 'provinces');

            $data = [
                'nim13' => $request->input('nim'),
                'nama_mhs' => $request->input('nama'),
                'tempat_lahir' => $request->input('tmp_lahir'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'periode' => $request->input('id_periode'),
                'jum_sks' => $request->input('sks'),
                'penyakit' => $request->input('penyakit') ?: '-',
                'informasi_lainnya' => $request->input('informasi_lainnya') ?: 'Tidak',
                'jenis_disabilitas' => $request->input('jenis_disabilitas') ?: '-',
                'nik_indonesia' => $request->input('nik'),
                'email' => $request->input('email'),
                'npwp' => $request->input('npwp') ?: '-',
                'nama_bank' => $request->input('nama_bank'),
                'no_rek' => $request->input('no_rek'),
                'agama' => $request->input('agama'),
                'status_sipil' => $request->input('status'),
                'no_telp_mhs' => $request->input('no_hp'),
                'no_telp_ayah' => $request->input('no_hp_ayah'),
                'no_telp_ibu' => $request->input('no_hp_ibu'),
                'no_telp_wali' => $request->input('no_hp_wali'),
                'alamat_mhs' => $alamat_lengkap,
                'ayah' => $request->input('nama_ayah'),
                'ibu' => $request->input('nama_ibu'),
                'wali' => $request->input('nama_wali'),
                'alamat_ayah' => $alamat_ayah,
                'alamat_ibu' => $alamat_ibu,
                'alamat_wali' => $alamat_wali,
                // 'jenis_kkn' => $dataa_periode['jenis_kkn'],
                'jenis_kkn' => $dataa_periode->jenis_kkn,
                'kelompok' => '',
                'id_lokasi' => 0,
                'status_reg' => 1,
                'kd_fjjp7' => substr($request->input('nim'), 2, 7),
                'kd_fakultas' => substr($request->input('nim'), 2, 2),
                'berkas' => '',
                'berkas_foto' => '',
                'berkas_izin_orang_tua' => '',
                'ip_reg' => $request->input('ip_address'),
                'id_kabupaten' => $request->input('kabupaten'),
                'talenta' => $request->input('talenta'),
                'kewarganegaraan' => $request->input('warga'),
                'negara_asing' => $request->input('negara_asing'),
                'bpjs' => $request->input('bpjs')
            ];

            if ($request->hasFile('berkas_izin')) {
                $path = $request->file('berkas_izin')->storeAs(
                    'uploads/berkas_izin',
                    'izin_orang_tua_' . $request->input('nim') . '_' . $id_periode . '.pdf'
                );
                $data['berkas_izin_orang_tua'] = basename($path);
            }

            if ($request->hasFile('berkas_dokter')) {
                $path = $request->file('berkas_dokter')->storeAs(
                    'uploads/berkas_dokter',
                    'izin_dokter_' . $request->input('nim') . '_' . $id_periode . '.pdf'
                );
                $data['berkas'] = basename($path);
            }

            $data_periode = DaftarModel::getDataPeriode($id_periode);

            // if ($data_periode->count() > 0) {
            if ($data_periode) {
                // $jenis_kkn = $data_periode->first()->jenis_kkn;
                $jenis_kkn = $data_periode->jenis_kkn;

                $data['jenis_kkn'] = $jenis_kkn;

                $hasil = DaftarModel::insertData('dbkkn.kkn', $data);

                if ($hasil === 'success') {
                    $data_nilai = [
                        'kd_kelompok' => '',
                        'nim13' => $request->input('nim'),
                        'periode' => $request->input('id_periode')
                    ];

                    $hasil = DaftarModel::insertData('dbkkn.nilai_kkn', $data_nilai);

                    if ($hasil === 'success') {
                        session()->put('daftar', true);
                        // return response()->json([
                        //     'status' => true,
                        //     'message' => 'Berhasil mendaftar'
                        // ]);
                        return response()->json(['status' => true, 'redirect_url' => route('mahasiswa')]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => $hasil
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => $hasil
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan'
                ]);
            }
        }
    }

    public function edit($id)
    {
        $kkns = Periode::findOrFail($id);
        $jenis_kkns = JenisKkn::all();
        return view('panitia.kkn-edit', compact('kkns', 'jenis_kkns'));
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

    public function getDesa(Request $request)
    {
        $id_kecamatan = $request->post('id_kecamatan');
        $data_kecamatan = DaftarModel::getDesa($id_kecamatan);
        $data_row = array();

        foreach ($data_kecamatan as $data) {
            $data_column = array();
            $data_column['id'] = $data->id;
            $data_column['desa'] = ucwords(strtolower($data->name));
            $data_row[] = $data_column;
        }

        return response()->json($data_row);
    }
}
