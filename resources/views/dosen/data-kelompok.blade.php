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
                                                                    <a class="menu-link" href="{{ route('dosen.beranda') }}">
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
                                                                    <a class="menu-link active" href="#" data-target="data-kelompok">
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
                                                                    <a class="menu-link" href="#" data-target="profil-desa">
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
                                                                    <a class="menu-link" href="#" data-target="survey-lapangan">
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
                                                                    <a class="menu-link" href="#" data-target="monev">
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
                                                                    <a class="menu-link" href="#" data-target="dokumen-kelompok">
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
                                                                    <a class="menu-link" href="#" data-target="nilai">
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
											<div class="card" id="content">
                                                <div id="data-kelompok" class="content-section">
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
                                                                        <td>: {{ $data['jenis_kkn'] }}</td>
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
                                                                        <td>Anggota Kelompok</td>
                                                                        <td>: </td>
                                                                    </tr>
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <a href="" class="btn btn-primary" target="blank">Atur Ketua Kelompok</a>
                                                        </div>
                                                        <div class="table-responsive mt-5">
                                                            @if($data['mhs_kelompok'] == "0")
                                                                <p>Data Kelompok tidak/belum tersedia</p>
                                                            @else
                                                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                                    <thead class="bg-gray-100">
                                                                        <tr>
                                                                            <th data-field="id">NIM</th>
                                                                            <th data-field="id">Nama</th>
                                                                            <th data-field="id">No. HP</th>
                                                                            <th data-field="price">Fakultas / Prodi</th>
                                                                            <th data-field="price">Status</th>
                                                                            <th data-field="price">Agama</th>
                                                                            <th data-field="price">Talenta</th>
                                                                            <th data-field="id"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($data['mhs_kelompok'] as $m)
                                                                        <tr>
                                                                            <td><?php echo $m->npm?></td>
                                                                            <td><?php echo $m->nama_mhs?></td>
                                                                            <td><?php echo $m->no_hp?></td>
                                                                            <td><?php echo $m->fakultas?> / <?php echo $m->jurusan?></td>
                                                                            <td><?php echo $m->status?></td>
                                                                            <td><?php echo $m->agama?></td>
                                                                            <td><?php echo $m->talenta?></td>
                                                                            <?php if($m->asal == 1) { ?>
                                                                                <td><p><a href="" data-nim = "<?php echo $m->npm?>" data-periode = "<?php echo $m->id_periode?>" class="btn btn-primary modal-trigger show-detail">Detail</a></p></td>
                                                                            <?php } elseif($m->asal == 2) { ?>
                                                                                <td><p><a href="" data-nim = "<?php echo $m->npm?>" data-periode = "<?php echo $m->id_periode?>" class="btn btn-primary modal-trigger show-detail-non">Detail</a></p></td>
                                                                            <?php }
                                                                            else { ?>
                                                                                <td></td>
                                                                            <?php } ?>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>

                                                <div id="profil-desa" class="content-section">
                                                    <!--begin::Card header-->
                                                    <div class="card-header" id="kt_chat_messenger_header">
                                                        <!--begin::Title-->
                                                        <div class="card-title">
                                                            <!--begin::User-->
                                                            <div class="d-flex justify-content-center flex-column me-3">
                                                                <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan Mengunggah Profil Desa</a>
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body" id="kt_chat_messenger_body">
                                                        <ol class="caption mt-0">
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Profil Desa dari tanggal {{ $data['mulai_laporan_survey'] }} sampai tanggal {{ $data['akhir_laporan_survey'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Maksimum ukuran file sebesar 10MB dengan format .pdf</p></li>
                                                        </ol>
                                                        @if ($dataKelompok->profil_desa == NULL)
                                                            <a class="btn btn-primary text-end">Belum Ada Berkas Yang Diupload</a>
                                                        @else
                                                            <a href="{{ route('dosen.download-dokumen', ['id_kelompok' =>  $data['id_kel'], 'jenis_doc' => 'profil_desa']) }}" class="btn btn-primary">Anda Sudah Menggunggah Dokumen, Unduh Dokumen Disini</a>
                                                        @endif
                                                        @if ($data['laporan_survey_ongoing'] === TRUE)
                                                            <form class="upload_dokumen" id="upload_dokumen_profil_desa" enctype="multipart/form-data" method="post" action="{{ route('dosen.uploadDokumen') }}">
                                                                @csrf
                                                                <div class="col m12 s12 l12 mt-5">
                                                                    <div class="row">
                                                                        <input name="id_kelompok" id="id_kel_accesable" value="{{ $data['id_kel'] }}" style="display: none">
                                                                        <input name="jenis-doc" id="jenis-doc-profil-desa" value="profil_desa" style="display: none">
                                                                        <div class="input-field col s12 m12 l12">
                                                                            <input name="dokumen_file" type="file" id="input-file-max-fs" class="form-control form-control-solid" data-max-file-size="10M" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="input-field col s12 mt-3">
                                                                            <button class="btn btn-primary float-end" type="submit" name="action">Submit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @else
                                                            <div class="row">
                                                                <div class="input-field col s12 mt-5">
                                                                    <span>Masa unggah Profil Desa belum dimulai atau telah lewat</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>

                                                <div id="survey-lapangan" class="content-section">
                                                    <!--begin::Card header-->
                                                    <div class="card-header" id="kt_chat_messenger_header">
                                                        <!--begin::Title-->
                                                        <div class="card-title">
                                                            <!--begin::User-->
                                                            <div class="d-flex justify-content-center flex-column me-3">
                                                                <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan Mengunggah Laporan Survey Lapangan</a>
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body" id="kt_chat_messenger_body">
                                                        <ol class="caption mt-0">
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Laporan Survey Lapangan dari tanggal {{ $data['mulai_laporan_survey'] }} sampai tanggal {{ $data['akhir_laporan_survey'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Maksimum ukuran file sebesar 10MB dengan format .pdf</p></li>
                                                        </ol>
                                                        @if ($dataKelompok->laporan_survey == NULL)
                                                            <a class="btn btn-primary text-end">Belum Ada Berkas Yang Diupload</a>
                                                        @else
                                                            <a href="{{ route('dosen.download-dokumen', ['id_kelompok' =>  $data['id_kel'], 'jenis_doc' => 'laporan_survey']) }}" class="btn btn-primary">Anda Sudah Menggunggah Dokumen, Unduh Dokumen Disini</a>
                                                        @endif
                                                        @if ($data['laporan_survey_ongoing'] === TRUE)
                                                            <form class="upload_dokumen" id="upload_dokumen_laporan_survey" enctype="multipart/form-data" method="post" action="{{ route('dosen.uploadDokumen') }}">
                                                                @csrf
                                                                <div class="col m12 s12 l12 mt-5">
                                                                    <div class="row">
                                                                        <input name="id_kelompok" id="id_kel_accesable" value="{{ $data['id_kel'] }}" style="display: none">
                                                                        <input name="jenis-doc" id="jenis-doc-laporan-survey" value="laporan_survey" style="display: none">
                                                                        <div class="input-field col s12 m12 l12">
                                                                            <input name="dokumen_file" type="file" id="input-file-max-fs" class="form-control form-control-solid" data-max-file-size="10M" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="input-field col s12 mt-3">
                                                                            <button class="btn btn-primary float-end" type="submit" name="action">Submit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @else
                                                            <div class="row">
                                                                <div class="input-field col s12 mt-5">
                                                                    <span>Masa unggah Laporan Survey belum dimulai atau telah lewat</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>

                                                <div id="monev" class="content-section">
                                                    <!--begin::Card header-->
                                                    <div class="card-header" id="kt_chat_messenger_header">
                                                        <!--begin::Title-->
                                                        <div class="card-title">
                                                            <!--begin::User-->
                                                            <div class="d-flex justify-content-center flex-column me-3">
                                                                <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan Mengunggah Laporan Monev</a>
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body" id="kt_chat_messenger_body">
                                                        <ol class="caption mt-0">
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Laporan Monev dari tanggal {{ $data['mulai_monev'] }} sampai tanggal {{ $data['akhir_monev'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Maksimum ukuran file sebesar 10MB dengan format .pdf</p></li>
                                                        </ol>
                                                        @if ($dataKelompok->monev == NULL)
                                                            <a class="btn btn-primary text-end">Belum Ada Berkas Yang Diupload</a>
                                                        @else
                                                            <a href="{{ route('dosen.download-dokumen', ['id_kelompok' =>  $data['id_kel'], 'jenis_doc' => 'monev']) }}" class="btn btn-primary">Anda Sudah Menggunggah Dokumen, Unduh Dokumen Disini</a>
                                                        @endif
                                                        @if ($data['monev_ongoing'] === TRUE)
                                                            <form class="upload_dokumen" id="upload_dokumen_monev" enctype="multipart/form-data" method="post" action="{{ route('dosen.uploadDokumen') }}">
                                                                @csrf
                                                                <div class="col m12 s12 l12 mt-5">
                                                                    <div class="row">
                                                                        <input name="id_kelompok" id="id_kel_accesable" value="{{ $data['id_kel'] }}" style="display: none">
                                                                        <input name="jenis-doc" id="jenis-doc-monev" value="monev" style="display: none">
                                                                        <div class="input-field col s12 m12 l12">
                                                                            <input name="dokumen_file" type="file" id="input-file-max-fs" class="form-control form-control-solid" data-max-file-size="10M" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="input-field col s12 mt-3">
                                                                            <button class="btn btn-primary float-end" type="submit" name="action">Submit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @else
                                                            <div class="row">
                                                                <div class="input-field col s12 mt-5">
                                                                    <span>Masa unggah Monev belum dimulai atau telah lewat</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>

                                                <div id="dokumen-kelompok" class="content-section">
                                                    <!--begin::Card header-->
                                                    <div class="card-header" id="kt_chat_messenger_header">
                                                        <!--begin::Title-->
                                                        <div class="card-title">
                                                            <!--begin::User-->
                                                            <div class="d-flex justify-content-center flex-column me-3">
                                                                <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Dokumen Peserta</a>
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body" id="kt_chat_messenger_body">
                                                        <ol class="caption mt-0">
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Proposal Program Kegiatan Kelompok dari tanggal {{ $data['mulai_proposal'] }} sampai tanggal {{ $data['akhir_proposal'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Logbook Minggu ke-1 dari tanggal {{ $data['mulai_logbook_1'] }} sampai tanggal {{ $data['akhir_logbook_1'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Logbook Minggu ke-2 dari tanggal {{ $data['mulai_logbook_2'] }} sampai tanggal {{ $data['akhir_logbook_2'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Logbook Minggu ke-3 dari tanggal {{ $data['mulai_logbook_3'] }} sampai tanggal {{ $data['akhir_logbook_3'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Logbook Minggu ke-4 dari tanggal {{ $data['mulai_logbook_4'] }} sampai tanggal {{ $data['akhir_logbook_4'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Laporan Akhir Program Kegiatan Kelompok dari tanggal  sampai tanggal  </p></li>
                                                        </ol>
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <tbody>
                                                                <tr class="bg-gray-100">
                                                                    <td>Proposal Kegiatan Kelompok</td>
                                                                    <?php if(!$data['proposal'] ) {?>
                                                                    <td class="td-align-right"><p><a href="" disabled="" class="btn btn-primary modal-trigger">Proposal belum diupload</a></p></td>
                                                                    <?php } else { ?>
                                                                    <td class="td-align-right"><p><a href="" data-jenis= "proposal" data-doc="<?php echo $data['proposal']?>" class="btn btn-primary modal-trigger download_dokumen">PDF</a></p></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr>
                                                                    <td>Logbook</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row mb-12">
                                                            <!--begin::Section-->
                                                                <div class="m-0">
                                                                    <!--begin::Heading-->
                                                                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_1">
                                                                        <!--begin::Icon-->
                                                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                            <i class="ki-duotone ki-book fs-1">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </div>
                                                                        <!--end::Icon-->
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Logbook Minggu ke-1</h4>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                    <!--begin::Body-->
                                                                    <div id="kt_job_4_1" class="collapse show fs-6 ms-1">
                                                                        <div class="table-responsive mt-5">
                                                                            <table class="table align-middle gs-0 gy-4">
                                                                                <thead class="bg-gray-100">
                                                                                    <tr>
                                                                                        <th data-field="id">Nama/NIM</th>
                                                                                        <th data-field="price">Fakultas/Prodi</th>
                                                                                        <th data-field="price">Dokumen</th>
                                                                                        <th data-field="price">Tautan Video</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php foreach($data['mhs_kelompok'] as $m){
                                                                                ?>
                                                                                <tr>
                                                                                    <td><?php echo $m->npm." / ".$m->nama_mhs?></td>
                                                                                    <td><?php echo $m->fakultas?> / <?php echo $m->jurusan?></td>
                                                                                    <?php if($m->logbook_1 === NULL ) {?>
                                                                                        <td><span  class="red-text">Belum di unggah</span></td>
                                                                                    <?php } else { ?>
                                                                                        <td><p><a href="" data-doc="<?php echo $m->logbook_1?>" data-jenis="logbook" class="btn btn-primary btn-sm modal-trigger download_dokumen">PDF</a></p></td>
                                                                                    <?php } ?>
                                                                                    <?php if($m->link_1 === NULL ) {?>
                                                                                        <td><span  class="red-text">Belum ada link yang ditambahkan</span></td>
                                                                                    <?php } else { ?>
                                                                                        <td><p><a href="<?php echo $m->link_1?>" class="btn btn-primary btn-sm modal-trigger">Buka Tautan</a></p></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                                <?php  } ?>
                                                                                </tbody>
                                                                            </table>
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
                                                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_2">
                                                                        <!--begin::Icon-->
                                                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                            <i class="ki-duotone ki-book fs-1">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </div>
                                                                        <!--end::Icon-->
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Logbook Minggu ke-2</h4>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                    <!--begin::Body-->
                                                                    <div id="kt_job_4_2" class="collapse fs-6 ms-1">
                                                                        <div class="table-responsive mt-5">
                                                                            <table class="table align-middle gs-0 gy-4">
                                                                                <thead class="bg-gray-100">
                                                                                    <tr>
                                                                                        <th data-field="id">Nama/NIM</th>
                                                                                        <th data-field="price">Fakultas/Prodi</th>
                                                                                        <th data-field="price">Dokumen</th>
                                                                                        <th data-field="price">Tautan Video</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php foreach($data['mhs_kelompok'] as $m){
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $m->npm." / ".$m->nama_mhs?></td>
                                                                                        <td><?php echo $m->fakultas?> / <?php echo $m->jurusan?></td>
                                                                                        <?php if($m->logbook_2 === NULL ) {?>
                                                                                            <td><span  class="red-text">Belum di unggah</span></td>
                                                                                        <?php } else { ?>
                                                                                            <td><p><a href="" data-doc="<?php echo $m->logbook_2?>" data-jenis="logbook" class="btn btn-primary btn-sm modal-trigger download_dokumen">PDF</a></p></td>
                                                                                        <?php } ?>
                                                                                        <?php if($m->link_2 === NULL ) {?>
                                                                                            <td><span  class="red-text">Belum ada link yang ditambahkan</span></td>
                                                                                        <?php } else { ?>
                                                                                            <td><p><a href="<?php echo $m->link_2?>" class="btn btn-primary btn-sm modal-trigger">Buka Tautan</a></p></td>
                                                                                        <?php } ?>
                                                                                    </tr>
                                                                                <?php  } ?>
                                                                                </tbody>
                                                                            </table>
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
                                                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_3">
                                                                        <!--begin::Icon-->
                                                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                            <i class="ki-duotone ki-book fs-1">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </div>
                                                                        <!--end::Icon-->
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Logbook Minggu ke-3</h4>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                    <!--begin::Body-->
                                                                    <div id="kt_job_4_3" class="collapse fs-6 ms-1">
                                                                        <div class="table-responsive mt-5">
                                                                            <table class="table align-middle gs-0 gy-4">
                                                                                <thead class="bg-gray-100">
                                                                                    <tr>
                                                                                        <th data-field="id">Nama/NIM</th>
                                                                                        <th data-field="price">Fakultas/Prodi</th>
                                                                                        <th data-field="price">Dokumen</th>
                                                                                        <th data-field="price">Tautan Video</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php foreach($data['mhs_kelompok'] as $m){
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $m->npm." / ".$m->nama_mhs?></td>
                                                                                        <td><?php echo $m->fakultas?> / <?php echo $m->jurusan?></td>
                                                                                        <?php if($m->logbook_3 === NULL ) {?>
                                                                                            <td><span  class="red-text">Belum di unggah</span></td>
                                                                                        <?php } else { ?>
                                                                                            <td><p><a href="" data-doc="<?php echo $m->logbook_3?>" data-jenis="logbook" class="btn btn-primary btn-sm modal-trigger download_dokumen">PDF</a></p></td>
                                                                                        <?php } ?>
                                                                                        <?php if($m->link_3 === NULL ) {?>
                                                                                            <td><span  class="red-text">Belum ada link yang ditambahkan</span></td>
                                                                                        <?php } else { ?>
                                                                                            <td><p><a href="<?php echo $m->link_3?>" class="btn btn-primary btn-sm modal-trigger">Buka Tautan</a></p></td>
                                                                                        <?php } ?>
                                                                                    </tr>
                                                                                <?php  } ?>
                                                                                </tbody>
                                                                            </table>
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
                                                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_4">
                                                                        <!--begin::Icon-->
                                                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                                            <i class="ki-duotone ki-book fs-1">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                                <span class="path4"></span>
                                                                            </i>
                                                                        </div>
                                                                        <!--end::Icon-->
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Logbook Minggu ke-4</h4>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                    <!--begin::Body-->
                                                                    <div id="kt_job_4_4" class="collapse fs-6 ms-1">
                                                                        <div class="table-responsive mt-5">
                                                                            <table class="table align-middle gs-0 gy-4">
                                                                                <thead class="bg-gray-100">
                                                                                    <tr>
                                                                                        <th data-field="id">Nama/NIM</th>
                                                                                        <th data-field="price">Fakultas/Prodi</th>
                                                                                        <th data-field="price">Dokumen</th>
                                                                                        <th data-field="price">Tautan Video</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php foreach($data['mhs_kelompok'] as $m){
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $m->npm." / ".$m->nama_mhs?></td>
                                                                                        <td><?php echo $m->fakultas?> / <?php echo $m->jurusan?></td>
                                                                                        <?php if($m->logbook_4 === NULL ) {?>
                                                                                            <td><span  class="red-text">Belum di unggah</span></td>
                                                                                        <?php } else { ?>
                                                                                            <td><p><a href="" data-doc="<?php echo $m->logbook_4?>" data-jenis="logbook" class="btn btn-primary btn-sm modal-trigger download_dokumen">PDF</a></p></td>
                                                                                        <?php } ?>
                                                                                        <?php if($m->link_4 === NULL ) {?>
                                                                                            <td><span  class="red-text">Belum ada link yang ditambahkan</span></td>
                                                                                        <?php } else { ?>
                                                                                            <td><p><a href="<?php echo $m->link_4?>" class="btn btn-primary btn-sm modal-trigger">Buka Tautan</a></p></td>
                                                                                        <?php } ?>
                                                                                    </tr>
                                                                                <?php  } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Content-->
                                                                </div>
                                                            <!--end::Section-->
                                                        </div>
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <tbody class="bg-gray-100">
                                                                <tr>
                                                                    <td>Laporan Akhir Kegiatan Kelompok</td>
                                                                    <?php if(!$data['laporan']) {?>
                                                                        <td class="td-align-right"><p><a href="" disabled="" class="btn btn-primary modal-trigger">Laporan belum diupload</a></p></td>
                                                                    <?php } else { ?>
                                                                        <td class="td-align-right"><p><a href="" data-jenis="laporan" data-doc="<?php echo $data['laporan'] ?>" class="btn btn-primary modal-trigger download_dokumen">PDF</a></p></td>
                                                                    <?php } ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>

                                                <div id="nilai" class="content-section">
                                                    <!--begin::Card header-->
                                                    <div class="card-header" id="kt_chat_messenger_header">
                                                        <!--begin::Title-->
                                                        <div class="card-title">
                                                            <!--begin::User-->
                                                            <div class="d-flex justify-content-center flex-column me-3">
                                                                <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Ketentuan Menggunggah Nilai Akhir Anggota Kelompok</a>
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <div class="card-body" id="kt_chat_messenger_body">
                                                        <ol class="caption mt-0">
                                                            <li><p class="caption mt-0 mb-0">Batas Unggah Nilai  dari tanggal {{ $data['mulai_upload_nilai'] }} sampai tanggal {{ $data['akhir_upload_nilai'] }}</p></li>
                                                            <li><p class="caption mt-0 mb-0">Memasukkan nilai dari DPL dan nilai dari geuchik gampong untuk setiap mahasiswa/mahasiswi pada kelompok tersebut</p></li>
                                                            <li><p class="caption mt-0 mb-0">Melampirkan dokumen bukti nilai untuk untuk setiap mahasiswa/mahasiswi pada kelompok tersebut yang disatukan dalam 1 dokumen</p></li>
                                                            <li><p class="caption mt-0 mb-0">Maksimum ukuran file sebesar 10MB dengan format .pdf</p></li>
                                                        </ol>
                                                    </div>
                                                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                                            <!--begin::Send-->
                                                            <a href="{" class="btn btn-primary" target="blank">Belum Ada Berkas Yang Diupload</a>
                                                            <!--end::Send-->
                                                        <!--end::Toolbar-->
                                                    </div>
                                                    <!--begin::Card body-->
                                                    <div class="card-body" id="kt_chat_messenger_body">
                                                        <div class="table-responsive">
                                                            <!--begin::Table-->
                                                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                                <thead class="bg-gray-100">
                                                                <tr>
                                                                    <th data-field="id">NIM</th>
                                                                    <th data-field="price">Nama Mahasiswa</th>
                                                                    <th data-field="price">Fakultas/Prodi</th>
                                                                    <th data-field="price">Nilai Geuchik</th>
                                                                    <th data-field="price">Nilai Akhir</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="table_nilai">
                                                                <?php
                                                                foreach($data['mhs_kelompok'] as $m){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $m->npm?></td>
                                                                        <td><?php echo $m->nama_mhs?></td>
                                                                        <td><?php echo $m->jurusan?> / <?php echo $m->fakultas?> </td>
                        <!--												  <td><input required placeholder="Nilai Dosen" name= "nilai_dosen[]"  type="number"></td>-->
                                                                            <input style="display: none" value="<?php echo $m->npm?>" name= "nim[]"  type="text">
                                                                            <input style="display: none" value="<?php echo $m->asal?>" name= "asal[]"  type="text">
                                                                        <td><input required placeholder="Nilai Geuchik" name= "nilai_geuchik[]" type="number"></td>
                                                                        <td><input required placeholder="Nilai DPL" name= "nilai_akhir[]" type="number" step="any"></td>
                                                                        <!-- <td><input required placeholder="Nilai Akhir" name= "nilai_akhir[]" type="number" step="any"></td> -->
                                                                    </tr>
                                                                <?php  } ?>
                                                                </tbody>
                                                            </table>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                item.addEventListener('click', function (event) {
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
            showSection('data-kelompok');
            menuItems[0].classList.add('active');
        });
    </script>

    <script>
        var uploadDokumenUrl = "{{ route('dosen.uploadDokumen') }}";

        $('.upload_dokumen').on('submit', function (event) {
        event.preventDefault();
        var formId = $(this).attr('id');
        var formData = new FormData(this);

        $.ajax({
            url: uploadDokumenUrl,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            dataType: "json",
            processData: false,
            success: function (data) {
                if (data.status) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.pesan,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Reload halaman setelah pesan sukses ditampilkan
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.pesan,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
                showDokumen(data.id_kelompok, data.jenis_doc);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire({
                    title: 'Error!',
                    text: "Status: " + textStatus + "\nError: " + errorThrown,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    </script>

    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
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
