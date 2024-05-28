<!DOCTYPE html>
<html>
<head>
    <title>Biodata Mahasiswa KKN</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 50px;
            height: auto;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
        }
        .header p {
            margin: 0;
            font-size: 12px;
        }
        .line {
            border-top: 1px solid #000;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('assets/media/logos/logo-kkn-2023.png') }}" alt="Logo">
        <h1>NAMA INSTITUSI</h1>
        <p>Alamat: Jl. Contoh No. 1, Kota Contoh, Provinsi Contoh</p>
        <p>Telepon: (021) 12345678, Email: info@institusi.ac.id</p>
    </div>
    <div class="line"></div>
    <div class="content">
    {{-- <div class="text-center mb-2">
        <h1>BIODATA CALON MAHASISWA KKN</h1>
        <h3>Periode {{ $data->masa_periode }}</h3>
    </div> --}}
    <h2 style="text-align: center;">BIODATA CALON MAHASISWA KKN</h2>
        <p style="text-align: center;">Periode </p>

    <p>Saya yang bertanda tangan di bawah ini:</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $data->nama_mhs }}</td>
        </tr>
        <tr>
            <td>NPM / NIK</td>
            <td>:</td>
            <td>{{ $data->nim13 }} / {{ $data->nik_indonesia }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>{{ $data->tempat_lahir }} / {{ $data->tgl_lahir }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $data->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $data->agama }}</td>
        </tr>
        <tr>
            <td>Fakultas / Prodi</td>
            <td>:</td>
            <td>{{ $data->nama_fakultas }} / {{ $data->nama_prodi }}</td>
        </tr>
        <tr>
            <td>SKS Yang Telah Dicapai</td>
            <td>:</td>
            <td>{{ $data->jum_sks }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $data->status_sipil }}</td>
        </tr>
        <tr>
            <td>No. Hand Phone / Email</td>
            <td>:</td>
            <td>{{ $data->no_telp_mhs }} / {{ $data->email }}</td>
        </tr>
        <tr>
            <td>BPJS Aktif</td>
            <td>:</td>
            <td>{{ $data->bpjs }}</td>
        </tr>
        <tr>
            <td>Alamat Domisili Saat Ini</td>
            <td>:</td>
            <td>{{ $data->alamat_mhs }}</td>
        </tr>
        <tr>
            <td>Penyakit Kronis Berat</td>
            <td>:</td>
            <td>{{ $data->penyakit }}</td>
        </tr>
        <tr>
            <td>Disabilitas</td>
            <td>:</td>
            <td>{{ $data->informasi_lainnya }}</td>
        </tr>
        <tr>
            <td>Jenis Disabilitas</td>
            <td>:</td>
            <td>{{ $data->jenis_disabilitas }}</td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>{{ $data->kewarganegaraan == "WNA" ? $data->kewarganegaraan ." / ". $data->negara_asing : $data->kewarganegaraan }}</td>
        </tr>
        <tr>
            <td>Talenta</td>
            <td>:</td>
            <td>{{ $data->talenta }}</td>
        </tr>
    </table>

    <div class="mt-4">
        <div class="text-center">
            <h2>SURAT PERNYATAAN KESEDIAAN MAHASISWA KKN</h2>
        </div>

        <p>Saya yang bertanda tangan di bawah ini:</p>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data->nama_mhs }}</td>
            </tr>
            <tr>
                <td>NPM</td>
                <td>:</td>
                <td>{{ $data->nim13 }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $data->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>{{ $data->nama_fakultas }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{ $data->nama_prodi }}</td>
            </tr>
            <tr>
                <td>Jumlah SKS yang sudah lulus</td>
                <td>:</td>
                <td>{{ $data->jum_sks }}</td>
            </tr>
            <tr>
                <td>HP/Whatsapp</td>
                <td>:</td>
                <td>{{ $data->no_telp_mhs }}</td>
            </tr>
        </table>

        <p>Dengan ini menyatakan sesungguhnya bersedia mengikuti Kuliah Kerja Nyata (KKN) Periode {{ $data->masa_periode }} sesuai ketentuan dan tata tertib yang dilaksanakan, diantaranya sudah menyelesaikan seluruh matakuliah kecuali tugas akhir dan BERSEDIA DITEMPATKAN DISELURUH WILAYAH PELAKSANAAN KKN PERIODE {{ $data->masa_periode }}.</p>

        {{-- <p class="text-center">Banda Aceh, {{ date('d') }} {{ $array_bulan[date('n')] }} {{ date('Y') }}</p> --}}

        <p>Mengetahui Orang Tua/Wali</p>
        <p>Mahasiswa Ybs,</p>

        <p>(..................................................)</p>
        <p class="text-center">( {{ $data->nama_mhs }} )</p>
    </div>
</body>
</html>
