@extends('metronic-layout')

<style>.menu-link {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    width: 100%;
    text-decoration: none; /* Menghapus garis bawah pada link */
    border-radius: 8px; /* Menambahkan rounded corners */
    transition: background-color 0.3s; /* Menambahkan transisi untuk perubahan latar belakang */
}

.menu-link.active {
    background-color: #f0f0f0; /* Warna latar belakang untuk link aktif */
    color: #000; /* Warna teks untuk link aktif */
    font-weight: bold; /* Membuat teks lebih tebal untuk link aktif */
}
</style>

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
								<!--begin::Toolbar container-->
								<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
									<!--begin::Page title-->
									<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
										<!--begin::Title-->
										<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dosen Pembimbing Lapangan KKN - Universitas Syiah Kuala</h1>
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
													<div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
														<!--begin::User-->
														<div class="d-flex flex-column py-4">
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dosen.beranda')) active @endif" href="{{ route('dosen.beranda') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-home fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Beranda</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('data_kelompok')) active @endif" href="{{ route('data_kelompok') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-profile-user fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Data Kelompok</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('profil_desa')) active @endif" href="{{ route('profil_desa') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Unggah Profil Desa</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('survey_lapangan')) active @endif" href="{{ route('survey_lapangan') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Unggah Laporan Survey Lapangan</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('monev')) active @endif" href="{{ route('monev') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Unggah Laporan Monev</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dokumen_kelompok')) active @endif" href="{{ route('dokumen_kelompok') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-document fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Dokumen Anggota Kelompok</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('nilai')) active @endif" href="{{ route('nilai') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Unggah Nilai</span>
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
											<div class="card" id="kt_chat_messenger">
												<!--begin::Card header-->
												<div class="card-header" id="kt_chat_messenger_header">
													<!--begin::Title-->
													<div class="card-title">
														<!--begin::User-->
														<div class="d-flex justify-content-center flex-column me-3">
															<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Data Kelompok</a>
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
                                                                    <td>: {{ $data['nama_periode'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenis Kegiatan KKN</td>
                                                                    <td>: </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kode Kelompok</td>
                                                                    <td>:  {{ $data['kd_kel'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lokasi Penempatan</td>
                                                                    <td>: {{ $data['lokasi_penempatan'] }}</td>
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
                                                                    <td>: -</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Anggota Kelompok</td>
                                                                    <td>: </td>
                                                                </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <a href="" class="btn btn-primary" target="blank">Atur Ketua Kelompok</a>
                                                    </div>
                                                    <div class="table-responsive mt-5">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <thead class="bg-gray-100">
                                                                <tr>
                                                                    <th class="text-center min-w-125px">NIM</th>
                                                                    <th class="text-center min-w-125px">Nama</th>
                                                                    <th class="text-center min-w-125px">No. HP</th>
                                                                    <th class="text-center min-w-125px">Fakultas / Prodi</th>
                                                                    <th class="text-center min-w-125px">Status</th>
                                                                    <th class="text-center min-w-125px">Agama</th>
                                                                    <th class="text-center min-w-125px">Talenta</th>
                                                                </tr>
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody>

                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                    </div>
												</div>
												<!--end::Card body-->
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
