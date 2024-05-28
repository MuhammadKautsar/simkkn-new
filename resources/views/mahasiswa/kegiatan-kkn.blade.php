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
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-home fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Beranda</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
														<!--begin::Separator-->
														<div class="separator separator-dashed d-none"></div>
														<!--end::Separator-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-profile-user fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Kelompok</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
														<!--begin::Separator-->
														<div class="separator separator-dashed d-none"></div>
														<!--end::Separator-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
                                                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Upload Berkas KKN</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
														<!--begin::Separator-->
														<div class="separator separator-dashed d-none"></div>
														<!--end::Separator-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Upload Proposal</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
														<!--begin::Separator-->
														<div class="separator separator-dashed d-none"></div>
														<!--end::Separator-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Upload Logbook</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
														<!--begin::Separator-->
														<div class="separator separator-dashed d-none"></div>
														<!--end::Separator-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-file-up fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Upload Laporan Akhir</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
														<!--begin::Separator-->
														<div class="separator separator-dashed d-none"></div>
														<!--end::Separator-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-4">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                                    <!--begin:Menu link-->
                                                                    <a class="menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                                                                    {{-- <span class="menu-link"> --}}
                                                                        <span class="menu-icon">
                                                                            <i class="ki-duotone ki-document fs-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </span>
                                                                    {{-- </span> --}}
                                                                    </a>
                                                                    <!--end:Menu link-->
                                                                </div>
																<!--begin::Details-->
																<div class="ms-5">
																	<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Nilai Akhir</a>
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
														</div>
														<!--end::User-->
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
															<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Data Pribadi</a>
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
                                                                    <td>: {{ $data['nama_mhs'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>NIM</td>
                                                                    <td>: {{ $data['nim13'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fakultas / Jurusan</td>
                                                                    <td>:  / </td>
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
                                                                    <td>: {{ $data['no_telp_mhs'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Riwayat Penyakit</td>
                                                                    <td>: </td>
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
														<a href="{{ route('cetak.pdf', ['nim13' => $data->nim13, 'periode' => $data->periode]) }}" class="btn btn-primary" target="blank">Unduh Berkas Lembar Pernyataan Mahasiswa KKN</a>
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
															<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Kegiatan KKN yang Diikuti</a>
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
                                                                    <td>: </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenis KKN</td>
                                                                    <td>: </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lokasi KKN</td>
                                                                    <td>:  / </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Periode KKN</td>
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
