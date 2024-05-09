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
                                            <div class="card-header pt-7 pb-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="text-gray-500 mt-1 fw-semibold fs-5">Sekarang anda memiliki {{ $jumlah_sks }} SKS</span>
                                                    <span class="text-gray-500 mt-1 fw-semibold fs-5">Anda belum mendaftar kegiatan KKN. Silahkan mendaftar kegiatan KKN yang sedang dibuka dibawah ini.</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
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
                                                    <span class="card-label fw-bold text-gray-800">Daftar Kegiatan KKN Universitas Syiah Kuala</span>
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
                                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Nama / Periode</th>
                                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Jenis</th>
                                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Lokasi</th>
                                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Masa Kegiatan</th>
                                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @foreach ($kkns as $kkn)
                                                            <tr>
                                                                <td class="mb-0 text-sm">{{ $kkn->masa_periode }}</td>
                                                                <td class="text-center mb-0 text-sm">{{ $kkn->jenisKkn->kategori }}</td>
                                                                <td class="text-center mb-0 text-sm">{{ $kkn->lokasi }}</td>
                                                                <td class="mb-0 text-sm">{{ $kkn->ket }}</td>
                                                                {{-- <td class="mb-0 text-sm">{{ $kkn->status }}</td> --}}
                                                                @if($kkn->status === 1)
                                                                    <td><span class="badge badge-primary">Aktif</span></td>
                                                                @endif
                                                                <td>
                                                                    <a href="{{ route('daftar') }}" class="btn btn-primary px-3 mb-0">Daftar</a>
                                                                </td>
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
