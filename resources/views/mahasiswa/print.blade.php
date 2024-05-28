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
            position: fixed;
            top: 0px;
            width: 100%;
        }
        .header img {
            width: 90px;
            height: auto;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
        }
        .header .institution {
            font-size: 20px;
        }
        .header p {
            margin: 0;
            font-size: 10px;
        }
        .line {
            border-top: 1px solid #000;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .content {
            margin-top: 120px;
        }
        .content p {
            margin: 5px 0;
        }
        .footer {
            position: fixed;
            bottom: 0px;
            width: 100%;
            text-align: left;
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        .biodata-table {
            width: 100%;
        }
        .biodata-table td {
            padding: 2px 5px;
        }
        .page-number {
            position: fixed;
            bottom: 10px;
            right: 10px;
            font-size: 10px;
        }
        .signatures {
            margin-top: 40px;
        }
        .signatures .left {
            float: left;
            width: 50%;
            text-align: left;
        }
        .signatures .right {
            float: right;
            width: 50%;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/media/logos/logo-usk.png') }}" alt="Logo" style="float: left;">
        <img src="{{ public_path('assets/media/logos/logo-kkn-2023.png') }}" alt="Logo" style="float: right;">
        <h1>PUSAT PENGEMBANGAN DAN PELAKSANAAN</h1>
        <h1>KULIAH KERJA NYATA (P3KKN)</h1>
        <h1>SISTEM INFORMASI KULIAH KERJA NYATA</h1>
        <h1 class="institution">UNIVERSITAS SYIAH KUALA</h1>
        <p>Jalan T. Nyak Arief, Gedung Biro Lama Lt.2, Lembaga Penelitian dan Pengabdian kepada Masyarakat, 23111</p>
        <p>Telp: (0651) 755-3205, 755-3248. Whatsapp: 08888-0750-5880. Email: kkn@usk.ac.id. Website: www.kkn.usk.ac.id</p>
        <div style="clear: both;"></div>
        <div class="line"></div>
    </div>

    <div class="content">
        <h2 style="text-align: center;">BIODATA CALON MAHASISWA KKN</h2>
        <p style="text-align: center;">Periode {{ $data->masa_periode }}</p>

        <p>Saya yang bertanda tangan di bawah ini:</p>
        <table class="biodata-table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data->nama_mhs }}</td>
                <td rowspan="5" style="text-align: center;">
                    <img src="{{ public_path('app-assets/foto-krs/'.$data->nim13.'.png') }}" style="height: 100px;">
                </td>
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
    </div>

    <div class="footer">
        <p>Dicetak pada tanggal: {{ $date }}</p>
    </div>

    <div class="page-number">
        <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_script('
                    if ($PAGE_COUNT > 1) {
                        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                        $size = 10;
                        $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                        $y = 15;
                        $x = 520;
                        $pdf->text($x, $y, $pageText, $font, $size);
                    }
                ');
            }
        </script>
    </div>

    <div class="page-break"></div>

    <div class="content">
        <h2 style="text-align: center;">SURAT PERNYATAAN KESEDIAAN MAHASISWA KKN</h2>
        <p>Saya yang bertanda tangan di bawah ini:</p>
        <table class="biodata-table">
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

    <p class="text-center">Banda Aceh, {{ $date }}</p>

    <div class="signatures">
        <div class="left">
            <p>Mengetahui Orang Tua/Wali</p>
            <p>(..................................................)</p>
        </div>
        <div class="right">
            <p>Mahasiswa Ybs,</p>
            <p>( {{ $data->nama_mhs }} )</p>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="footer">
    <p>Dicetak pada tanggal: {{ $date }}</p>
</div>
</body>
</html>
