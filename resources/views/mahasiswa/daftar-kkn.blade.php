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
										<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Formulir Registrasi Online KKN</h1>
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
                                <!--begin::Row-->
                                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                    <!--begin::Col-->
                                    <div class="col-xl-12">
                                        <!--begin::Table widget 14-->
                                        <div class="card card-flush h-md-100">
											<!--begin::Form-->
											<form class="form" action="{{ route('submit_registrasi') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="periode" value="{{ $periodeId }}">
                                                <!--begin::Header-->
                                                <div class="card-header pt-7">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Biodata/Pernyataan Mahasiswa KKN</span><br>
                                                        <span class="text-muted fw-semibold fs-7">Jika data tidak ada, maka diisi dengan "-"</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card body-->
                                                    <div class="card-body pt-5">
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Nama</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="text" class="form-control form-control-solid" name="nama" value="{{ $mahasiswa['nama'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">NIM</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="text" class="form-control form-control-solid" name="nim" value="{{ $mahasiswa['npm'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">NIK</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="nik" value="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Tempat Lahir</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="text" class="form-control form-control-solid" name="tmp_lahir" value="{{ $mahasiswa['tempat_lahir'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Tanggal Lahir</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="date" class="form-control form-control-solid" name="tgl_lahir" value="{{ $mahasiswa['tanggal_lahir'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Jenis Kelamin</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="text" class="form-control form-control-solid" name="jenis_kelamin" value="{{ $mahasiswa['jenis_kelamin'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Jumlah SKS yang Telah Lulus</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="number" class="form-control form-control-solid" name="sks" value="{{ $jumlah_sks }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Email</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input readonly type="email" class="form-control form-control-solid" name="email" value="{{ $mahasiswa['email'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">No. Handphone</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" class="form-control form-control-solid" name="no_hp" value="{{ $mahasiswa['no_tlp_mhs'] }}" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->

                                                    </div>
                                                <!--end::Card body-->
                                                <!--begin::Header-->
                                                <div class="card-header pt-1">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Silahkan lengkapi data-data di bawah ini</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card body-->
                                                    <div class="card-body pt-5">
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Agama</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="agama" data-placeholder="Pilih Agama">
                                                                                <option value="" disabled selected>Pilih Agama</option>
                                                                                <option value="Islam">Islam</option>
                                                                                <option value="Kristen Katolik">Kristen Katolik</option>
                                                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                                                <option value="Hindu">Hindu</option>
                                                                                <option value="Budha">Budha</option>
                                                                                <option value="Konghuchu">Konghuchu</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">BPJS</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="bpjs" data-placeholder="Pilih BPJS">
                                                                                <option value="" disabled selected>Pilih BPJS</option>
                                                                                <option value="Ada">Ada</option>
                                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Talenta</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="talenta" data-placeholder="Pilih Talenta">
                                                                                <option value="" disabled selected>Pilih Talenta</option>
                                                                                <option value="Moderator" >Moderator</option>
                                                                                <option value="Qori">Qori</option>
                                                                                <option value="Pembaca Doa">Pembaca Doa</option>
                                                                                <option value="Dirigen">Dirigen</option>
                                                                                <option value="Orator / Motivator">Orator / Motivator</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Status</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="status" data-placeholder="Pilih Status">
                                                                                <option value="" disabled selected>Pilih Status</option>
                                                                                <option value="Menikah">Menikah</option>
                                                                                <option value="Belum Menikah">Belum Menikah</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Kewarganegaraan</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="warga" data-placeholder="Pilih Kewarganegaraan">
                                                                                <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                                                                <option value="WNI">WNI</option>
                                                                                <option value="WNA">WNA</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Warga Negara Asing</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="negara_asing" placeholder="Negara Kewarganegaraan Asing" />
                                                                        <span class="helper-text">Hanya diisi untuk WNA</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="provinsi">
                                                                            <span class="required">Provinsi Domisili Saat Ini</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="provinsi" class="provinsi form-select form-select-solid"
                                                                            name="id_provinsi" data-placeholder="Pilih Provinsi" data-target="#kabupaten">
                                                                                <option value="" disabled selected>Pilih Provinsi</option>
                                                                                @foreach($provinsi as $prov)
                                                                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="kabupaten">
                                                                            <span class="required">Kabupaten Domisili Saat Ini</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kabupaten" class="kabupaten form-select form-select-solid" name="id_kabupaten" data-placeholder="Pilih Kabupaten" data-target="#kecamatan">
                                                                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="kecamatan">
                                                                            <span class="required">Kecamatan Domisili Saat Ini</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kecamatan" class="kecamatan form-select form-select-solid" name="kecamatan" data-placeholder="Pilih Kecamatan">
                                                                                <option value="" disabled selected>Pilih Kecamatan</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Alamat Domisili Saat Ini</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="alamat_lengkap" placeholder="Alamat Domisili Saat Ini" />
                                                                        <span class="helper-text">Hanya isi nama jalan dan nama desa saja</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Penyakit Berat yang Pernah Diderita</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="penyakit">
                                                                                <option value="-">Pilih Jenis Penyakit</option>
                                                                                <option value="Schizoprenia">Schizoprenia</option>
                                                                                <option value="Epilipsi">Epilipsi</option>
                                                                                <option value="Dementia">Dementia</option>
                                                                                <option value="Drug Abuse">Drug Abuse</option>
                                                                                <option value="Trauma phsikis">Trauma phsikis</option>
                                                                                <option value="TBC">TBC</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Penyakit Lain</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="penyakit_lain" placeholder="atau Isi Penyakit" />
                                                                        <span class="helper-text">Bila tidak memiliki penyakit berat, kolom diatas di isi dengan "-".</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Disabilitas</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="informasi_lainnya" data-placeholder="Disabilitas">
                                                                                <option value="" disabled selected>Pilih salah satu</option>
                                                                                <option value="Ya">Ya</option>
                                                                                <option value="Tidak">Tidak</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Jenis disabilitas</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="jenis_disabilitas" placeholder="Jenis disabilitas" />
                                                                        <span class="helper-text">Bila tidak ada, kolom diatas dapat dikosongkan.</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->

                                                    </div>
                                                <!--end::Card body-->
                                                <!--begin::Header-->
                                                <div class="card-header pt-1">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Data Ayah</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card body-->
                                                    <div class="card-body pt-5">
                                                        <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Nama Ayah</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="nama_ayah" placeholder="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>No. Telpon Ayah</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="no_hp_ayah" placeholder="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="provinsi_ayah">
                                                                            <span class="required">Provinsi</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="provinsi_ayah" class="provinsi form-select form-select-solid" name="provinsi_ayah" data-placeholder="Pilih Provinsi" data-target="#kabupaten_ayah">
                                                                                <option value="" disabled selected>Pilih Provinsi</option>
                                                                                @foreach($provinsi as $prov)
                                                                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="kabupaten_ayah">
                                                                            <span class="required">Kabupaten</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kabupaten_ayah" class="kabupaten form-select form-select-solid" name="kabupaten_ayah" data-placeholder="Pilih Kabupaten" data-target="#kecamatan_ayah">
                                                                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="kecamatan_ayah">
                                                                            <span class="required">Kecamatan</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kecamatan_ayah" class="form-select form-select-solid" name="kecamatan_ayah" data-placeholder="Pilih Kecamatan">
                                                                                <option value="" disabled selected>Pilih Kecamatan</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Alamat Ayah</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="alamat_lengkap_ayah" placeholder="Alamat Ayah" />
                                                                        <span class="helper-text">Hanya isi nama jalan dan nama desa saja</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                        <!--end::Row-->
                                                    </div>
                                                <!--end::Card body-->
                                                <!--begin::Header-->
                                                <div class="card-header pt-1">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Data Ibu</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card body-->
                                                    <div class="card-body pt-5">
                                                        <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Nama Ibu</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="nama_ibu" placeholder="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>No. Telpon Ibu</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="no_hp_ibu" placeholder="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="provinsi_ibu">
                                                                            <span class="required">Provinsi</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="provinsi_ibu" class="provinsi form-select form-select-solid"
                                                                            name="provinsi_ibu" data-placeholder="Pilih Provinsi" data-target="#kabupaten_ibu">
                                                                                <option value="" disabled selected>Pilih Provinsi</option>
                                                                                @foreach($provinsi as $prov)
                                                                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="kabupaten_ibu">
                                                                            <span class="required">Kabupaten</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kabupaten_ibu" class="kabupaten form-select form-select-solid" name="kabupaten_ibu" data-placeholder="Pilih Kabupaten" data-target="#kecamatan_ibu">
                                                                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3" for="kecamatan_ibu">
                                                                            <span class="required">Kecamatan</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kecamatan_ibu" class="form-select form-select-solid" name="kecamatan_ibu" data-placeholder="Pilih Kecamatan">
                                                                                <option value="" disabled selected>Pilih Kecamatan</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Alamat Ibu</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="alamat_lengkap_ibu" placeholder="Alamat Ibu" />
                                                                        <span class="helper-text">Hanya isi nama jalan dan nama desa saja</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                        <!--end::Row-->
                                                    </div>
                                                <!--end::Card body-->
                                                <!--begin::Header-->
                                                <div class="card-header pt-1">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Data Wali</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card body-->
                                                    <div class="card-body pt-5">
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>Nama Wali</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="nama_Wali" placeholder="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span>No. Telpon Wali</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="no_hp_wali" placeholder="" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Provinsi</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="provinsi_wali" class="provinsi form-select form-select-solid" name="provinsi_wali" data-placeholder="Pilih Provinsi" data-target="#kabupaten_wali">
                                                                                <option value="" disabled selected>Pilih Provinsi</option>
                                                                                @foreach($provinsi as $prov)
                                                                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Kabupaten</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kabupaten_wali" class="kabupaten form-select form-select-solid" name="kabupaten_wali" data-placeholder="Pilih Kabupaten" data-target="#kecamatan_wali">
                                                                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Kecamatan</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <div class="w-100">
                                                                            <!--begin::Select2-->
                                                                            <select id="kecamatan_wali" class="kecamatan form-select form-select-solid" name="kecamatan_wali" data-placeholder="Pilih Kecamatan">
                                                                                <option value="" disabled selected>Pilih Kecamatan</option>
                                                                            </select>
                                                                            <!--end::Select2-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                                            <span class="required">Alamat Wali</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" name="alamat_lengkap_wali" placeholder="Alamat Wali" />
                                                                        <span class="helper-text">Hanya isi nama jalan dan nama desa saja</span>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                    </div>
                                                <!--end::Card body-->
                                                <!--begin::Header-->
                                                <div class="card-header pt-1">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Unggah Berkas</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card body-->
                                                    <div class="card-body pt-5">
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                                    <span class="required">Berkas Surat Izin Orang Tua/Surat Izin Suami</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="file" class="form-control form-control-solid" name="berkas_izin" value="" />
                                                                <span class="helper-text">Upload Berkas Surat Izin Orang Tua/Surat Izin Suami serta berkas lainya yang dibutuhkan ( Maksimum File 2MB, Format File: PDF)</span>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                                    <span>Berkas surat keterangan dokter</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="file" class="form-control form-control-solid" name="berkas_dokter" value="" />
                                                                <span class="helper-text">Upload Berkas surat keterangan dokter. (Maksimum File 2MB, Format File: PDF)</span>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->

                                                            <div class="row p-2">
                                                            <label for="syarat">Memenuhi Persyaratan :</label>
                                                                <label>
                                                                    <input type="checkbox" name="terms" id="terms" required> Mencapai 100 sks
                                                                </label>
                                                            </div>

                                                            <!--begin::Separator-->
                                                            <div class="separator mb-6"></div>
                                                            <!--end::Separator-->
                                                            <!--begin::Action buttons-->
                                                            <div class="d-flex justify-content-end">
                                                                <!--begin::Button-->
                                                                <a href="/beranda"><button data-kt-contacts-type="cancel" class="btn btn-light me-3">Cancel</button></a>
                                                                <!--end::Button-->
                                                                <!--begin::Button-->
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                <!--end::Button-->
                                                            </div>
                                                            <!--end::Action buttons-->
                                                    </div>
                                                <!--end::Card body-->
                                            </form>
                                            <!--end::Form-->
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('body').on('change', '.provinsi', function () {
                var id_provinsi = $(this).val();
                var targetDropdown = $(this).data('target');

                $.ajax({
                    url: '/get-kabupaten',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id_provinsi: id_provinsi
                    },
                    success: function (data) {
                        $(targetDropdown).empty();
                        // console.log(id_provinsi);
                        $(targetDropdown).append($('<option>').val('').text('Pilih Kabupaten/Kota'));
                        $.each(data, function (key, value) {
                            $(targetDropdown).append($('<option>').val(value.id).text(value.kabupaten));
                        });
                    }
                });
            });

            $('body').on('change', '.kabupaten', function () {
                var id_kabupaten = $(this).val();
                var targetDropdown = $(this).data('target');

                $.ajax({
                    url: '/get-kecamatan',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id_kabupaten: id_kabupaten
                    },
                    success: function (data) {
                        $(targetDropdown).empty();
                        $(targetDropdown).append($('<option>').val('').text('Pilih Kecamatan'));
                        $.each(data, function (key, value) {
                            $(targetDropdown).append($('<option>').val(value.id).text(value.kecamatan));
                        });
                    }
                });
            });
        });
    </script>

</body>
