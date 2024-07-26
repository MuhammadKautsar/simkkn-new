@extends('metronic-layout')

<style>
    .menu-link {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        width: 100%;
        text-decoration: none;
        /* Menghapus garis bawah pada link */
        border-radius: 8px;
        /* Menambahkan rounded corners */
        transition: background-color 0.3s;
        /* Menambahkan transisi untuk perubahan latar belakang */
    }

    .menu-link.active {
        background-color: #f0f0f0;
        /* Warna latar belakang untuk link aktif */
        color: #000;
        /* Warna teks untuk link aktif */
        font-weight: bold;
        /* Membuat teks lebih tebal untuk link aktif */
    }
</style>

<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true"
    class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('layouts.header-user')
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                        Peserta KKN Universitas Syiah Kuala</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Layout-->
                                <div class="d-flex flex-column flex-lg-row">
                                    <!--begin::Sidebar-->
                                    <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                                        <!--begin::Contacts-->
                                        <div class="card card-flush">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-5" id="kt_chat_contacts_body">
                                                <!--begin::List-->
                                                <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                                                    data-kt-scroll-activate="{default: false, lg: true}"
                                                    data-kt-scroll-max-height="auto"
                                                    data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                                                    data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                                                    data-kt-scroll-offset="5px">
                                                    <!--begin::User-->
                                                    <div class="d-flex flex-column py-4">
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion" style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link active" href="#"
                                                                    data-target="beranda">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-home fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Beranda</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion" style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link" href="#"
                                                                    data-target="kelompok">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-profile-user fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Kelompok</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion" style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link" href="#"
                                                                    data-target="upload-berkas">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-file-up fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload
                                                                        Berkas KKN</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion" style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link" href="#"
                                                                    data-target="upload-proposal">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-file-up fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload
                                                                        Proposal</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion" style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link" href="#"
                                                                    data-target="upload-logbook">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-file-up fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload
                                                                        Logbook</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion"
                                                                style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link" href="#"
                                                                    data-target="upload-laporan">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-file-up fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload
                                                                        Laporan Akhir</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <div class="menu-item menu-accordion"
                                                                style="width: 100%;">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link" href="#"
                                                                    data-target="nilai-akhir">
                                                                    <span class="menu-icon me-3">
                                                                        <i class="ki-duotone ki-document fs-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                            <span class="path4"></span>
                                                                        </i>
                                                                    </span>
                                                                    <span
                                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Nilai
                                                                        Akhir</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::List-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Contacts-->
                                    </div>
                                    <!--end::Sidebar-->
                                    <!--begin::Content-->
                                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                                        <div class="card" id="content">
                                            <div id="beranda" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Data
                                                                Pribadi</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>: {{ $data['nama'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>NIM</td>
                                                                    <td>: {{ $data['nim'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fakultas / Jurusan</td>
                                                                    <td>: {{ $data['fakultas'] }} /
                                                                        {{ $data['jurusan'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Agama</td>
                                                                    <td>: {{ $data['agama'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenis Kelamin</td>
                                                                    <td>: {{ $data['jenis_kelamin'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>No Handhphone</td>
                                                                    <td>: {{ $data['no_hp'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Riwayat Penyakit</td>
                                                                    <td>: {{ $data['riwayat_penyakit'] }}</td>
                                                                </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                                    <!--begin::Send-->
                                                    <a href="{{ route('cetak.pdf', ['nim13' => $data['nim'], 'periode' => $data['periode']]) }}"
                                                        class="btn btn-primary" target="blank">Unduh Berkas Lembar
                                                        Pernyataan Mahasiswa KKN</a>
                                                    <!--end::Send-->
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Card footer-->
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Kegiatan
                                                                KKN yang Diikuti</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                                <tr>
                                                                    <td>Nama/Periode KKN</td>
                                                                    @if ($data['nama_kkn'] == null)
                                                                        <td>: {{ $data['nama_periode'] }}</td>
                                                                    @else
                                                                        <td>: {{ $data['nama_kkn'] }}</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenis KKN</td>
                                                                    <td>: {{ $data['jenis_kkn'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lokasi KKN</td>
                                                                    <td>: -</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Periode KKN</td>
                                                                    <td>: {{ $data['masa_periode'] }}</td>
                                                                </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                            </div>

                                            <div id="kelompok" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Data
                                                                Kelompok</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                                <tr>
                                                                    <td>Nama/Periode KKN</td>
                                                                    @if ($data['nama_kkn'] == null)
                                                                        <td>: {{ $data['nama_periode'] }}</td>
                                                                    @else
                                                                        <td>: {{ $data['nama_kkn'] }}</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenis Kegiatan KKN</td>
                                                                    <td>: {{ $data['jenis_kkn'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kode Kelompok</td>
                                                                    <td>: {{ $data['kode_kel'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lokasi Penempatan</td>
                                                                    <td>: {{ $data['desa_penempatan'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Geuchik Gampong</td>
                                                                    <td>: {{ $data['nama_geuchik'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>No Handhphone Geuchik Gampong</td>
                                                                    <td>: {{ $data['no_hp_geuchik'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dosen Pembimbing Lapangan</td>
                                                                    <td>: {{ $data['nama_dpl'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Laporan Profil Desa</td>
                                                                    @if ($data['profil_desa'] == '-')
                                                                        <td>: {{ $data['profil_desa'] }}</td>
                                                                    @elseif ($data['profil_desa'] == null)
                                                                        <td>: <a class="btn btn-primary text-end">Profil
                                                                                Desa Belum Di Upload</a></td>
                                                                    @else
                                                                        <td>: <a href="{{ route('dosen.download-dokumen', ['id_kelompok' => $data['kelompok'], 'jenis_doc' => 'profil_desa']) }}"
                                                                                class="btn btn-primary">Unduh
                                                                                Dokumen</a></td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td>Laporan Survey Dosen</td>
                                                                    @if ($data['laporan_survey'] == '-')
                                                                        <td>: {{ $data['laporan_survey'] }}</td>
                                                                    @elseif ($data['laporan_survey'] == null)
                                                                        <td>: <a class="btn btn-primary text-end">Laporan
                                                                                Survey Dosen Belum Di Upload</a></td>
                                                                    @else
                                                                        <td>: <a href="{{ route('dosen.download-dokumen', ['id_kelompok' => $data['kelompok'], 'jenis_doc' => 'laporan_survey']) }}"
                                                                                class="btn btn-primary">Unduh
                                                                                Dokumen</a></td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td>Anggota Kelompok</td>
                                                                    <td>: </td>
                                                                </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        @if ($data['mhs_kelompok'] == '0')
                                                            <p>Data Kelompok tidak/belum tersedia</p>
                                                        @else
                                                            <table
                                                                class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                                <thead class="bg-gray-100">
                                                                    <tr>
                                                                        <th data-field="id">NIM</th>
                                                                        <th data-field="id">Nama</th>
                                                                        <th data-field="price">Jenis Kelamin</th>
                                                                        <th data-field="name">No. Handphone</th>
                                                                        <th data-field="price">Fakultas/Prodi</th>
                                                                        <th data-field="price">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data['mhs_kelompok'] as $m)
                                                                        <tr>
                                                                            <td><?php echo $m->npm; ?></td>
                                                                            <td><?php echo $m->nama_mhs; ?></td>
                                                                            <td><?php echo $m->jenis_kelamin; ?></td>
                                                                            <td><?php echo $m->no_hp; ?></td>
                                                                            <td><?php echo $m->fakultas; ?> /
                                                                                <?php echo $m->jurusan; ?></td>
                                                                            <td><?php echo $m->status; ?></td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                            </div>

                                            <div id="upload-berkas" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan
                                                                Mengunggah Berkas KKN</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <ol class="caption mt-0">
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Unggah Proposal Berkas
                                                                KKN dari tanggal {{ $data['mulai_proposal'] }} sampai
                                                                tanggal {{ $data['akhir_proposal'] }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Maksimum ukuran file sebesar
                                                                10MB dengan format .pdf</p>
                                                        </li>
                                                    </ol>
                                                    @if ($data['berkas_kkn'] == NULL)
                                                        <a class="btn btn-primary text-end">Belum Ada Berkas Yang Diupload</a>
                                                    @else
                                                        <a href="{{ route('mahasiswa.download-berkas', ['nim' =>  $data['nim'], 'jenis_doc' => 'berkas_kkn', 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                    @endif
                                                    <form class="submit_berkas" id="berkas" method="post"
                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                        @csrf
                                                        <input type="hidden" name="id_periode"
                                                            value="{{ $data['id_periode'] }}">
                                                        <input type="hidden" name="nim"
                                                            value="{{ $data['nim'] }}">
                                                        <div class="col m12 s12 l12 mt-5">
                                                            <div class="row">
                                                                <div class="input-field col s12 m12 l12">
                                                                    <input type="file" required name="berkas_kkn"
                                                                        id="berkas_kkn"
                                                                        class="form-control form-control-solid"
                                                                        data-max-file-size="10MB"
                                                                        accept="application/pdf" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12 mt-3">
                                                                    <button class="btn btn-primary float-end"
                                                                        type="submit" name="action">Submit
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div id="upload-proposal" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan
                                                                Mengunggah Proposal Program Kerja Kelompok</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <ol class="caption mt-0">
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Unggah Proposal Program
                                                                Kerja Kelompok dari tanggal
                                                                {{ $data['mulai_proposal'] }} sampai tanggal
                                                                {{ $data['akhir_proposal'] }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Maksimum ukuran file sebesar
                                                                10MB dengan format .pdf</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Proposal Program Kerja
                                                                Kelompok hanya dapat di unggah oleh ketua kelompok</p>
                                                        </li>
                                                    </ol>
                                                    @if ($data['proposal_kkn'] == NULL)
                                                        <a class="btn btn-primary text-end">Belum Ada Berkas Yang Diupload</a>
                                                    @else
                                                        <a href="{{ route('mahasiswa.download-dokumen', ['kode_kel' => $data['kode_kel'], 'jenis_doc' => 'proposal_kkn', 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                    @endif
                                                    <form class="submit_berkas" id="proposal" method="post"
                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                        @csrf
                                                        <input type="hidden" name="id_periode"
                                                            value="{{ $data['id_periode'] }}">
                                                        <input type="hidden" name="kode_kel"
                                                            value="{{ $data['kode_kel'] }}">
                                                        <input type="hidden" name="id_kelompok"
                                                            value="{{ $data['id_kelompok'] }}">
                                                        <div class="col m12 s12 l12 mt-5">
                                                            <div class="row">
                                                                <div class="input-field col s12 m12 l12">
                                                                    <input type="file" required name="proposal_kkn"
                                                                        id="proposal_kkn"
                                                                        class="form-control form-control-solid"
                                                                        data-max-file-size="10MB"
                                                                        accept="application/pdf" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12 mt-3">
                                                                    <button class="btn btn-primary float-end"
                                                                        type="submit" name="action">Submit
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div id="upload-logbook" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan
                                                                Mengunggah Logbook Mingguan</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <ol class="caption mt-0">
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Upload Logbook Minggu
                                                                ke-1 dari tanggal {{ $data['mulai_logbook_1'] }} sampai
                                                                tanggal {{ $data['akhir_logbook_1'] }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Upload Logbook Minggu
                                                                ke-2 dari tanggal {{ $data['mulai_logbook_2'] }} sampai
                                                                tanggal {{ $data['akhir_logbook_2'] }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Upload Logbook Minggu
                                                                ke-3 dari tanggal {{ $data['mulai_logbook_3'] }} sampai
                                                                tanggal {{ $data['akhir_logbook_3'] }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Upload Logbook Minggu
                                                                ke-4 dari tanggal {{ $data['mulai_logbook_4'] }} sampai
                                                                tanggal {{ $data['akhir_logbook_4'] }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Maksimum ukuran file sebesar
                                                                5MB dengan format .pdf</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Menyertakan tautan dokumentasi
                                                                video kegiatan (1 video untuk 1 logbook mingguan) yang
                                                                telah di unggah sesuai arahan panitia</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Tautan yang disertakan mohon
                                                                diisi dengan 1 tautan saja tanpa ada penambahan karakter
                                                                lainnya. Contoh tautan: https://www.youtube.com</p>
                                                        </li>
                                                    </ol>
                                                    <a href="{{ url('berkas/Format_Logbook_2021.pdf') }}" class="btn btn-primary" target="blank">Unduh
                                                        Format Logbook</a>
                                                    <div class="row mb-12 mt-5">
                                                        <!--begin::Section-->
                                                        <div class="m-0">
                                                            <!--begin::Heading-->
                                                            <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#kt_job_4_1">
                                                                <!--begin::Icon-->
                                                                <div
                                                                    class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                    <i class="ki-duotone ki-book fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </div>
                                                                <!--end::Icon-->
                                                                <!--begin::Title-->
                                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                                    Logbook Minggu ke-1</h4>
                                                                <!--end::Title-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <!--begin::Body-->
                                                            <div id="kt_job_4_1" class="collapse show fs-6 ms-1">
                                                                <div class="card-body" id="kt_chat_messenger_body">
                                                                    <div class="caption mt-0">
                                                                        @if ($datalb['link1'] == NULL)
                                                                            <p class="caption mt-0 mb-4">Belum ada link yang ditambahkan</p>
                                                                        @else
                                                                            <p class="caption mt-0 mb-4">Link yang sudah ditambahkan :<br>{{ $datalb['link1'] }}</p>
                                                                        @endif
                                                                    </div>
                                                                    @if ($datalb['logbook1'] == NULL)
                                                                        <button disabled="" class="btn btn-dark">Belum Ada Berkas Yang Diupload</button>
                                                                    @else
                                                                        <a href="{{ route('mahasiswa.download-logbook', ['nim' => $data['nim'], 'jenis_doc' => 'logbook', 'urutan_logbook' => 1, 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                                    @endif
                                                                    <form class="submit_berkas" id="logbook1" method="post"
                                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="id_periode"
                                                                            value="{{ $data['id_periode'] }}">
                                                                        <div class="col m12 s12 l12 mt-5">
                                                                            <div class="row">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <label for="">Tautan</label>
                                                                                    <input type="hidden" name="urutan_link" value="1">
                                                                                    <input type="text" name="link" required placeholder="Contohnya: https://www.youtube.com/"
                                                                                        id="link"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-5">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <input type="hidden" name="nim" value="{{ $data['nim'] }}">
                                                                                    <input type="hidden" name="urutan_logbook" value="1">
                                                                                    <input type="file" required name="logbook"
                                                                                        id="logbook"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="input-field col s12 mt-3">
                                                                                    <button class="btn btn-primary float-end"
                                                                                        type="submit" name="action">Submit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!--end::Content-->
                                                            <!--begin::Separator-->
                                                            <div class="separator separator-dashed"></div>
                                                            <!--end::Separator-->
                                                        </div>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <div class="m-0">
                                                            <!--begin::Heading-->
                                                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#kt_job_4_2">
                                                                <!--begin::Icon-->
                                                                <div
                                                                    class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                    <i class="ki-duotone ki-book fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </div>
                                                                <!--end::Icon-->
                                                                <!--begin::Title-->
                                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                                    Logbook Minggu ke-2</h4>
                                                                <!--end::Title-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <!--begin::Body-->
                                                            <div id="kt_job_4_2" class="collapse fs-6 ms-1">
                                                                <div class="card-body" id="kt_chat_messenger_body">
                                                                    <div class="caption mt-0">
                                                                        @if ($datalb['link2'] == NULL)
                                                                            <p class="caption mt-0 mb-4">Belum ada link yang ditambahkan</p>
                                                                        @else
                                                                            <p class="caption mt-0 mb-4">Link yang sudah ditambahkan :<br>{{ $datalb['link2'] }}</p>
                                                                        @endif
                                                                    </div>
                                                                    @if ($datalb['logbook2'] == NULL)
                                                                        <button disabled="" class="btn btn-dark">Belum Ada Berkas Yang Diupload</button>
                                                                    @else
                                                                        <a href="{{ route('mahasiswa.download-logbook', ['nim' => $data['nim'], 'jenis_doc' => 'logbook', 'urutan_logbook' => 2, 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                                    @endif
                                                                    <form class="submit_berkas" id="logbook2" method="post"
                                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="id_periode"
                                                                            value="{{ $data['id_periode'] }}">
                                                                        <div class="col m12 s12 l12 mt-5">
                                                                            <div class="row">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <label for="">Tautan</label>
                                                                                    <input type="hidden" name="urutan_link" value="2">
                                                                                    <input type="text" name="link" required placeholder="Contohnya: https://www.youtube.com/"
                                                                                        id="link"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-5">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <input type="hidden" name="nim" value="{{ $data['nim'] }}">
                                                                                    <input type="hidden" name="urutan_logbook" value="2">
                                                                                    <input type="file" required name="logbook"
                                                                                        id="logbook"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="input-field col s12 mt-3">
                                                                                    <button class="btn btn-primary float-end"
                                                                                        type="submit" name="action">Submit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!--end::Content-->
                                                            <!--begin::Separator-->
                                                            <div class="separator separator-dashed"></div>
                                                            <!--end::Separator-->
                                                        </div>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <div class="m-0">
                                                            <!--begin::Heading-->
                                                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#kt_job_4_3">
                                                                <!--begin::Icon-->
                                                                <div
                                                                    class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                    <i class="ki-duotone ki-book fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </div>
                                                                <!--end::Icon-->
                                                                <!--begin::Title-->
                                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                                    Logbook Minggu ke-3</h4>
                                                                <!--end::Title-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <!--begin::Body-->
                                                            <div id="kt_job_4_3" class="collapse fs-6 ms-1">
                                                                <div class="card-body" id="kt_chat_messenger_body">
                                                                    <div class="caption mt-0">
                                                                        @if ($datalb['link3'] == NULL)
                                                                            <p class="caption mt-0 mb-4">Belum ada link yang ditambahkan</p>
                                                                        @else
                                                                            <p class="caption mt-0 mb-4">Link yang sudah ditambahkan :<br>{{ $datalb['link3'] }}</p>
                                                                        @endif
                                                                    </div>
                                                                    @if ($datalb['logbook3'] == NULL)
                                                                        <button disabled="" class="btn btn-dark">Belum Ada Berkas Yang Diupload</button>
                                                                    @else
                                                                        <a href="{{ route('mahasiswa.download-logbook', ['nim' => $data['nim'], 'jenis_doc' => 'logbook', 'urutan_logbook' => 3, 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                                    @endif
                                                                    <form class="submit_berkas" id="logbook3" method="post"
                                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="id_periode"
                                                                            value="{{ $data['id_periode'] }}">
                                                                        <div class="col m12 s12 l12 mt-5">
                                                                            <div class="row">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <label for="">Tautan</label>
                                                                                    <input type="hidden" name="urutan_link" value="3">
                                                                                    <input type="text" name="link" required placeholder="Contohnya: https://www.youtube.com/"
                                                                                        id="link"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-5">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <input type="hidden" name="nim" value="{{ $data['nim'] }}">
                                                                                    <input type="hidden" name="urutan_logbook" value="3">
                                                                                    <input type="file" required name="logbook"
                                                                                        id="logbook"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="input-field col s12 mt-3">
                                                                                    <button class="btn btn-primary float-end"
                                                                                        type="submit" name="action">Submit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!--end::Content-->
                                                            <!--begin::Separator-->
                                                            <div class="separator separator-dashed"></div>
                                                            <!--end::Separator-->
                                                        </div>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <div class="m-0">
                                                            <!--begin::Heading-->
                                                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#kt_job_4_4">
                                                                <!--begin::Icon-->
                                                                <div
                                                                    class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                    <i class="ki-duotone ki-book fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </div>
                                                                <!--end::Icon-->
                                                                <!--begin::Title-->
                                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                                    Logbook Minggu ke-4</h4>
                                                                <!--end::Title-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <!--begin::Body-->
                                                            <div id="kt_job_4_4" class="collapse fs-6 ms-1">
                                                                <div class="card-body" id="kt_chat_messenger_body">
                                                                    <div class="caption mt-0">
                                                                        @if ($datalb['link4'] == NULL)
                                                                            <p class="caption mt-0 mb-4">Belum ada link yang ditambahkan</p>
                                                                        @else
                                                                            <p class="caption mt-0 mb-4">Link yang sudah ditambahkan :<br>{{ $datalb['link4'] }}</p>
                                                                        @endif
                                                                    </div>
                                                                    @if ($datalb['logbook4'] == NULL)
                                                                        <button disabled="" class="btn btn-dark">Belum Ada Berkas Yang Diupload</button>
                                                                    @else
                                                                        <a href="{{ route('mahasiswa.download-logbook', ['nim' => $data['nim'], 'jenis_doc' => 'logbook', 'urutan_logbook' => 4, 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                                    @endif
                                                                    <form class="submit_berkas" id="logbook4" method="post"
                                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="id_periode"
                                                                            value="{{ $data['id_periode'] }}">
                                                                        <div class="col m12 s12 l12 mt-5">
                                                                            <div class="row">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <label for="">Tautan</label>
                                                                                    <input type="hidden" name="urutan_link" value="4">
                                                                                    <input type="text" name="link" required placeholder="Contohnya: https://www.youtube.com/"
                                                                                        id="link"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-5">
                                                                                <div class="input-field col s12 m12 l12">
                                                                                    <input type="hidden" name="nim" value="{{ $data['nim'] }}">
                                                                                    <input type="hidden" name="urutan_logbook" value="4">
                                                                                    <input type="file" required name="logbook"
                                                                                        id="logbook"
                                                                                        class="form-control form-control-solid"
                                                                                        data-max-file-size="10MB"
                                                                                        accept="application/pdf" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="input-field col s12 mt-3">
                                                                                    <button class="btn btn-primary float-end"
                                                                                        type="submit" name="action">Submit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!--end::Content-->
                                                        </div>
                                                        <!--end::Section-->
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                            </div>

                                            <div id="upload-laporan" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            <a href="#"
                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan
                                                                Mengunggah laporan Akhir Program Kerja Kelompok</a>
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <ol class="caption mt-0">
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Batas Unggah Proposal Program
                                                                Kerja Kelompok dari tanggal
                                                                {{ $data['mulai_laporan'] }} sampai tanggal
                                                                {{ $data['akhir_laporan'] }} </p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Maksimum ukuran file sebesar
                                                                10MB dengan format .pdf</p>
                                                        </li>
                                                        <li>
                                                            <p class="caption mt-0 mb-0">Laporan Akhir Program Kerja
                                                                Kelompok hanya dapat di unggah oleh ketua kelompok</p>
                                                        </li>
                                                    </ol>
                                                    @if ($data['laporan_kkn'] == NULL)
                                                        <a class="btn btn-primary text-end">Belum Ada Berkas Yang Diupload</a>
                                                    @else
                                                        <a href="{{ route('mahasiswa.download-dokumen', ['jenis_doc' => 'laporan_kkn', 'kode_kel' => $data['kode_kel'], 'id_periode' => $data['id_periode']]) }}" class="btn btn-primary">Unduh Dokumen</a>
                                                    @endif
                                                    <form class="submit_berkas" id="laporan" method="post"
                                                        enctype="multipart/form-data" action="{{ route('mahasiswa.upload-berkas') }}">
                                                        @csrf
                                                        <input type="hidden" name="nim"
                                                            value="{{ $data['nim'] }}">
                                                        <input type="hidden" name="id_periode"
                                                            value="{{ $data['id_periode'] }}">
                                                        <input type="hidden" name="kode_kel"
                                                            value="{{ $data['kode_kel'] }}">
                                                        <input type="hidden" name="id_kelompok"
                                                            value="{{ $data['id_kelompok'] }}">
                                                        <div class="col m12 s12 l12 mt-5">
                                                            <div class="row">
                                                                <div class="input-field col s12 m12 l12">
                                                                    <input type="file" required name="laporan_kkn"
                                                                        id="laporan_kkn"
                                                                        class="form-control form-control-solid"
                                                                        data-max-file-size="10MB"
                                                                        accept="application/pdf" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12 mt-3">
                                                                    <button class="btn btn-primary float-end"
                                                                        type="submit" name="action">Submit
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div id="nilai-akhir" class="content-section">
                                                <!--begin::Card header-->
                                                <div class="card-header" id="kt_chat_messenger_header">
                                                    <!--begin::Title-->
                                                    <div class="card-title">
                                                        <!--begin::User-->
                                                        <div class="d-flex justify-content-center flex-column me-3">
                                                            @if ($data['nama_kkn'] == null)
                                                                <a href="#"
                                                                    class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Nilai
                                                                    Akhir {{ $data['nama_periode'] }}</a>
                                                            @else
                                                                <a href="#"
                                                                    class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Nilai
                                                                    Akhir {{ $data['nama_kkn'] }}</a>
                                                            @endif
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <div class="table-responsive">
                                                        @if ($data['status_nilai_mhs'] != 0)
                                                            <table
                                                                class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                                <thead class="bg-gray-100">
                                                                    <tr>
                                                                        <th data-field="id">NIM</th>
                                                                        <th data-field="id">Nama</th>
                                                                        <th data-field="price">Fakultas / Prodi</th>
                                                                        <th data-field="id">Nilai Akhir</th>
                                                                        <th data-field="id">Predikat Nilai</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table_mhs">
                                                                    <tr>
                                                                        <td>{{ $data['nim'] }}</td>
                                                                        <td>{{ $data['nama'] }}</td>
                                                                        <td>{{ $data['fakultas'] }} /
                                                                            {{ $data['jurusan'] }}</td>
                                                                        @if ($data['nilai_mhs'])
                                                                            <td>{{ $data['nilai_mhs']->nilai_des }}
                                                                            </td>
                                                                            <td>{{ $data['nilai_mhs']->nilai }}</td>
                                                                        @else
                                                                            <td colspan="2"
                                                                                style="text-align: center;">Nilai Tidak
                                                                                Tersedia</td>
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <table class="bordered responsive-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th data-field="id">NIM</th>
                                                                        <th data-field="id">Nama</th>
                                                                        <th data-field="price">Fakultas / Prodi</th>
                                                                        <th data-field="id">Nilai Akhir</th>
                                                                        <th data-field="id">Predikat Nilai</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table_mhs">
                                                                    <tr>
                                                                        <td colspan="5"
                                                                            style="text-align: center;">Nilai Belum
                                                                            Diumumkan</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Layout-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        <div
                            class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <!--begin::Copyright-->
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                <a href="https://kkn.usk.ac.id" target="_blank"
                                    class="text-gray-800 text-hover-primary">KKN Universitas Syiah Kuala</a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                                <li class="menu-item">
                                    <a class="menu-link px-2">Developed by UPT. Teknologi Informasi dan Komunikasi</a>
                                </li>
                            </ul>
                            <!--end::Menu-->
                        </div>
                        <!--end::Footer container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-link');
            const contentSections = document.querySelectorAll('.content-section');

            // Function to hide all content sections
            function hideAllSections() {
                contentSections.forEach(section => {
                    section.style.display = 'none';
                });
            }

            // Function to show the target section
            function showSection(target) {
                document.getElementById(target).style.display = 'block';
            }

            // Function to remove active class from all menu items
            function removeActiveClass() {
                menuItems.forEach(item => {
                    item.classList.remove('active');
                });
            }

            // Add event listener to each menu item
            menuItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    // Check if the menu link has a data-target attribute
                    if (this.hasAttribute('data-target')) {
                        event.preventDefault();
                        hideAllSections();
                        showSection(this.getAttribute('data-target'));
                        removeActiveClass();
                        this.classList.add('active');
                    }
                });
            });

            // Show the first section by default and set the first menu item as active
            hideAllSections();
            showSection('beranda');
            menuItems[0].classList.add('active');
        });
    </script>

    <script>
        $(document).ready(function() {
            var uploadDokumenUrl = "{{ route('mahasiswa.upload-berkas') }}";

            $('.submit_berkas').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);

                $.ajax({
                    url: uploadDokumenUrl,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    processData: false,
                    success: function(data) {
                        if(data.status){
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.pesan,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                // Perbarui konten div setelah upload berhasil
                                var targetDiv = '#upload-' + form.attr('id'); // Ambil ID form untuk target div
                                updateContent(targetDiv);
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.pesan,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Status: " + textStatus + ", Error: " + errorThrown,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            function updateContent(targetDiv) {
                $.ajax({
                    url: window.location.href, // Mengambil konten dari URL saat ini
                    method: 'GET',
                    success: function(response) {
                        var newContent = $(response).find(targetDiv).html();
                        $(targetDiv).html(newContent); // Perbarui div dengan konten baru
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal memperbarui konten.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    </script>

    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
