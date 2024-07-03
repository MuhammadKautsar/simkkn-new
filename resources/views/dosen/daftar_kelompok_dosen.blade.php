@extends('metronic-layout')

<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
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
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Row-->
                                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                    <!--begin::Col-->
                                    <div class="col-xl-12">
                                        <!--begin::Table widget 14-->
                                        <div class="card card-flush h-md-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7 pb-3">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Profil</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::body-->
                                            <div class="card-body pt-2 pb-2">
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            <tr>
                                                            <td>Nama</td>
                                                            <td>: {{ $data['data_dosen']->nama }}</td>
                                                            <td>Fakultas / Nama Unit</td>
                                                            <td>: {{ $data['data_dosen']->nama_fakultas }} / {{ $data['data_dosen']->nama_unit }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>NIP/NIK</td>
                                                            <td>: {{ $data['data_dosen']->nip }}</td>
                                                            <td>Status</td>
                                                            <td>: {{ strtoupper($data['data_dosen']->status) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>NIP/NIK Korcam</td>
                                                            <td>: {{ $data['data_korcam']->nip }}</td>
                                                            <td>Nama Korcam</td>
                                                            <td>: {{ $data['data_korcam']->nama }}</td>
                                                        </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                            </div>
                                            <!--end::body-->
                                            <!--begin::footer-->
                                            <div class="card-footer pt-2 pb-7">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="{{ route('download.panduan', ['filename' => 'PANDUAN-PENGGUNAAN-SISTEM-APLIKASI-KULIAH-KERJA-NYATA.pdf']) }}" class="btn btn-primary px-3 mb-0"><i class="ki-solid ki-cloud-download fs-2x"></i>Unduh Panduan</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::footer-->
                                        </div>
                                        <!--end::Table widget 14-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                    <!--begin::Col-->
                                    <div class="col-xl-12">
                                        <!--begin::Table widget 14-->
                                        <div class="card card-flush h-md-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Daftar Kelompok yang Anda Bimbing</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-6">
                                                <!--begin::Table container-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                        <!--begin::Table head-->
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th class="text-center min-w-125px">Nama / Periode</th>
                                                                <th class="text-center min-w-125px">Jenis KKN</th>
                                                                <th class="text-center min-w-125px">Kode Kelompok</th>
                                                                <th class="text-center min-w-125px">Ketua Kelompok</th>
                                                                <th class="text-center min-w-125px">Lokasi Penempatan</th>
                                                                <th class="text-center min-w-125px">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @foreach ($data['daftar_kelompok'] as $k)
                                                            <tr>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->periode }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->kategori }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->kd_kelompok }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->ketua_kel }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->lokasi_penempatan }}</td>
                                                                <td><a href="{{ route('data_kelompok', $k->id) }}" class="btn btn-primary px-3 mb-0">Detail</a></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end: Card Body-->
                                        </div>
                                        <!--end::Table widget 14-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                    <!--begin::Col-->
                                    <div class="col-xl-12">
                                        <!--begin::Table widget 14-->
                                        <div class="card card-flush h-md-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Daftar Kelompok dibawah Koordinator Kecamatan</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-6">
                                                <!--begin::Table container-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                        <!--begin::Table head-->
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th class="text-center min-w-125px">Nama / Periode</th>
                                                                <th class="text-center min-w-125px">Jenis KKN</th>
                                                                <th class="text-center min-w-125px">Kode Kelompok</th>
                                                                <th class="text-center min-w-125px">Nama DPL</th>
                                                                <th class="text-center min-w-125px">Nama Desa</th>
                                                                <th class="text-center min-w-125px">Nama Kecamatan</th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @foreach ($data['daftar_kelompok_korcam'] as $k)
                                                            <tr>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->periode }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->kategori }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->kd_kelompok }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->nama_dpl }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->nama_desa }}</td>
                                                                <td class="text-gray-700 mt-1 fw-semibold fs-4">{{ $k->nama_kecamatan }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end: Card Body-->
                                        </div>
                                        <!--end::Table widget 14-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <!--begin::Copyright-->
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                <a href="https://kkn.usk.ac.id" target="_blank" class="text-gray-800 text-hover-primary">KKN Universitas Syiah Kuala</a>
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

    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>