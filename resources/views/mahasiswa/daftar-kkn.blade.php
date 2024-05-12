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
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Daftar KKN</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-6">
                                                <form action="{{ route('kkn.store') }}" method="POST">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="nama_kkn">Nama Mahasiswa:</label>
                                                            <input disabled type="text" name="nama_kkn" id="nama_kkn" class="form-control" value="{{ $mahasiswa['nama'] }}">
                                                            @error('nama_kkn')
                                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="masa_kegiatan">NPM:</label>
                                                            <input disabled type="text" name="masa_kegiatan" id="masa_kegiatan" class="form-control" value="{{ $mahasiswa['npm'] }}">
                                                            @error('masa_kegiatan')
                                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row p-2">
                                                        <label for="jenis_kkn">Alamat</label>
                                                        <input type="text" name="jenis_kkn" id="jenis_kkn" placeholder="" class="form-control" required value="{{ $mahasiswa['alamat'] }}">
                                                        @error('jenis_kkn')
                                                            <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="masa_pendaftaran">Tempat lahir:</label>
                                                            <input disabled type="text" name="masa_pendaftaran" id="masa_pendaftaran" placeholder="" class="form-control" value="{{ $mahasiswa['tempat_lahir'] }}">
                                                            @error('masa_pendaftaran')
                                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-6">
                                                            <label for="">Tanggal lahir</label>
                                                            <input disabled type="text" name="" id="" placeholder="" class="form-control" value="{{ $mahasiswa['tanggal_lahir'] }}">
                                                            @error('')
                                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="tahun_ajaran">Nomor hp:</label>
                                                            <input type="text" name="tahun_ajaran" id="tahun_ajaran" placeholder="" class="form-control" required value="{{ $mahasiswa['no_tlp_mhs'] }}">
                                                            @error('tahun_ajaran')
                                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-6">
                                                            <label for="semester">Nomor hp ayah:</label>
                                                            <input type="text" name="semester" id="semester" placeholder="" class="form-control" required>
                                                            @error('semester')
                                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row p-2">
                                                        <label for="kode_kkn">jumlah sks:</label>
                                                        <input disabled type="text" name="kode_kkn" id="kode_kkn" placeholder="" class="form-control" required value="{{ $jumlah_sks }}">
                                                        @error('kode_kkn')
                                                            <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row p-2">
                                                        <label for="kuota_peserta">Upload Berkas</label>
                                                        <input type="file" name="kuota_peserta" id="kuota_peserta" placeholder="" class="form-control" required>
                                                        @error('kuota_peserta')
                                                            <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row p-2">
                                                        <label for="kuota_peserta">Memenuhi Persyaratan :</label>
                                                        <label>
                                                            <input type="checkbox" name="terms" id="terms" required> Mencapai 100 sks
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="mt-6 mb-0 btn btn-success btn-sm float-end">Daftar</button>
                                                </form>
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
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
