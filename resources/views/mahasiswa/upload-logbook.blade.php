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
										<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Peserta KKN Universitas Syiah Kuala</h1>
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
                                                                    <a class="menu-link @if(request()->routeIs('mahasiswa')) active @endif" href="{{ route('mahasiswa') }}">
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
                                                                    <a class="menu-link @if(request()->routeIs('kelompok')) active @endif" href="{{ route('kelompok') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-profile-user fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Kelompok</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('upload-berkas')) active @endif" href="{{ route('upload-berkas') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload Berkas KKN</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('upload-proposal')) active @endif" href="{{ route('upload-proposal') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload Proposal</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('upload-logbook')) active @endif" href="{{ route('upload-logbook') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload Logbook</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('upload-laporan')) active @endif" href="{{ route('upload-laporan') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Upload Laporan Akhir</span>
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <div class="menu-item menu-accordion" style="width: 100%;">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('nilai-akhir')) active @endif" href="{{ route('nilai-akhir') }}">
                                                                        <span class="menu-icon me-3">
                                                                            <i class="ki-duotone ki-document fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                        <span class="fs-5 fw-bold text-gray-900 text-hover-primary mb-0">Nilai Akhir</span>
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
															<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan Mengunggah Logbook Mingguan</a>
														</div>
														<!--end::User-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Card header-->
												<!--begin::Card body-->
												<div class="card-body" id="kt_chat_messenger_body">
                                                    <span>1. Batas Upload Logbook Minggu ke-1 dari tanggal - sampai tanggal -</span><br>
                                                    <span>2. Batas Upload Logbook Minggu ke-2 dari tanggal - sampai tanggal -</span><br>
                                                    <span>3. Batas Upload Logbook Minggu ke-3 dari tanggal - sampai tanggal -</span><br>
                                                    <span>4. Batas Upload Logbook Minggu ke-4 dari tanggal - sampai tanggal -</span><br>
                                                    <span>5. Maksimum ukuran file sebesar 5MB dengan format .pdf</span><br>
                                                    <span>6. Menyertakan tautan dokumentasi video kegiatan (1 video untuk 1 logbook mingguan) yang telah di unggah sesuai arahan panitia</span><br>
                                                    <span>7. Tautan yang disertakan mohon diisi dengan 1 tautan saja tanpa ada penambahan karakter lainnya. Contoh tautan: https://www.youtube.com</span><br>
												</div>
												<!--end::Card body-->
												<!--begin::Card footer-->
												<div class="card-footer pt-4" id="kt_chat_messenger_footer">
														<!--begin::Send-->
														<a href="{" class="btn btn-primary" target="blank">Unduh Format Logbook</a>
														<!--end::Send-->
													<!--end::Toolbar-->
												</div>
												<!--end::Card footer-->
												<!--begin::Card body-->
												<div class="card-body" id="kt_chat_messenger_body">
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                                <tr>
                                                                    <td>Upload Logbook Minggu ke-1</td>
                                                                    <td>: </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Upload Logbook Minggu ke-2</td>
                                                                    <td>: </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Upload Logbook Minggu ke-3</td>
                                                                    <td>:  / </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Upload Logbook Minggu ke-4</td>
                                                                    <td>: </td>
                                                                </tr>
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
