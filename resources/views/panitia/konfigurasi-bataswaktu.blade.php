@extends('layouts.panitia-layout')

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Konfigurasi Batas Waktu KKN Baru</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Daftar Kegiatan KKN</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Konfigurasi Batas Waktu Kegiatan KKN Baru</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
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

                        <div class="card mb-8">
                            <!--begin::Hero body-->
                            <div class="card-body flex-column p-5">
                                <!--begin::Hero nav-->
                                <div class="card-rounded bg-light d-flex flex-stack flex-wrap p-3">
                                    <!--begin::Nav-->
                                    <ul class="nav flex-wrap border-transparent fw-bold">
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.edit', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-document fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Deskripsi</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.konfigurasi_dosen', ['id' => $kkn->id]) }}"><i class="ki-solid ki-profile-circle fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Dosen</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.konfigurasi_lokasi', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-geolocation fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Lokasi</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.konfigurasi_peserta', ['id' => $kkn->id]) }}"><i class="ki-solid ki-profile-user fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Peserta dan Kelompok</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3 active" href="{{ route('kkn.konfigurasi_bataswaktu', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-calendar fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Batasan Waktu</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.konfigurasi_monitoring', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-monitor-mobile fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Monitoring</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.konfigurasi_nilaiakhir', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-questionnaire-tablet fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Nilai Akhir</a>
                                        </li>
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Hero nav-->
                            </div>
                            <!--end::Hero body-->
                        </div>

                        <div class="card card-flush">
                            <!--begin::Header-->
                            <div class="card-header pt-1">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Input Batas Waktu Dosen</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div id="elementId1" class="card-body pt-5">
                                <!--begin::Form-->
                                <form id="submit_batas_waktu_dosen">
                                    @csrf
                                    <input type="hidden" name="id_periode" value="{{ $kkn->id }}">
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Laporan Survey Dosen:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_laporan_survey" placeholder="Dari Tanggal" value="{{ $batasanWaktu['mulai_laporan_survey'] }}" />
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
                                                    <span>Akhir Upload Laporan Survey Dosen:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_laporan_survey" placeholder="" value="{{ $batasanWaktu['akhir_laporan_survey'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Profil Desa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_profil" placeholder=""/>
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
                                                    <span>Akhir Upload Profil Desa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_profil" placeholder=""/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Laporan Monev:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_monev" placeholder="" value="{{ $batasanWaktu['mulai_monev'] }}"/>
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
                                                    <span>Akhir Upload Laporan Monev:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_monev" placeholder="" value="{{ $batasanWaktu['akhir_monev'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Nilai:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_upload_nilai" placeholder="" value="{{ $batasanWaktu['mulai_upload_nilai'] }}"/>
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
                                                    <span>Akhir Upload Nilai:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_upload_nilai" placeholder="" value="{{ $batasanWaktu['akhir_upload_nilai'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Separator-->
                                    <div class="separator mb-6"></div>
                                    <!--end::Separator-->
                                    <!--begin::Action buttons-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Action buttons-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card body-->
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-1">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Input Batas Waktu Mahasiswa/Mahasiswi</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div id="elementId2" class="card-body pt-5">
                                <!--begin::Form-->
                                <form id="submit_batas_waktu_mahasiswa">
                                    @csrf
                                    <input type="hidden" name="id_periode_mhs" value="{{ $kkn->id }}">
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Laporan Proposal Kegiatan Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_upload_proposal" placeholder="Dari Tanggal" value="{{ $batasanWaktu['mulai_upload_proposal'] }}"/>
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
                                                    <span>Akhir Upload Laporan Proposal Kegiatan Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_upload_proposal" placeholder="" value="{{ $batasanWaktu['akhir_upload_proposal'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Logbook Minggu Ke-1 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_logbook_1" placeholder="" value="{{ $batasanWaktu['mulai_logbook_1'] }}"/>
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
                                                    <span>Akhir Upload Logbook Minggu Ke-1 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_logbook_1" placeholder="" value="{{ $batasanWaktu['akhir_logbook_1'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Logbook Minggu Ke-2 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_logbook_2" placeholder="" value="{{ $batasanWaktu['mulai_logbook_2'] }}"/>
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
                                                    <span>Akhir Upload Logbook Minggu Ke-2 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_logbook_2" placeholder="" value="{{ $batasanWaktu['akhir_logbook_2'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Logbook Minggu Ke-3 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_logbook_3" placeholder="" value="{{ $batasanWaktu['mulai_logbook_3'] }}"/>
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
                                                    <span>Akhir Upload Logbook Minggu Ke-3 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_logbook_3" placeholder="" value="{{ $batasanWaktu['akhir_logbook_3'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Logbook Minggu Ke-4 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_logbook_4" placeholder="" value="{{ $batasanWaktu['mulai_logbook_4'] }}"/>
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
                                                    <span>Akhir Upload Logbook Minggu Ke-4 Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_logbook_4" placeholder="" value="{{ $batasanWaktu['akhir_logbook_4'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Mulai Upload Laporan Akhir Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="mulai_laporan" placeholder="" value="{{ $batasanWaktu['mulai_laporan'] }}"/>
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
                                                    <span>Akhir Upload Laporan Akhir Mahasiswa:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid"
                                                    name="akhir_laporan" placeholder="" value="{{ $batasanWaktu['akhir_laporan'] }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Separator-->
                                    <div class="separator mb-6"></div>
                                    <!--end::Separator-->
                                    <!--begin::Action buttons-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Action buttons-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card body-->
                        </div>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#submit_batas_waktu_dosen').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                url: "{{ route('set.batas.waktu.dosen') }}",
                dataType: "JSON",
                cache: false,
                success: function(data) {
                    if (data) {
                        Swal.fire({
                            title: 'Batas waktu berhasil diperbaharui',
                            icon: 'success',
                        });
                    } else {
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            icon: 'error',
                        });
                    }
                    setData(); // Update data if needed
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });
        $('#submit_batas_waktu_mahasiswa').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                url: "{{ route('set.batas.waktu.mahasiswa') }}",
                dataType: "JSON",
                cache: false,
                success: function(data) {
                    if (data) {
                        Swal.fire({
                            title: 'Batas waktu berhasil diperbaharui',
                            icon: 'success',
                        });
                    } else {
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            icon: 'error',
                        });
                    }
                    setData(); // Update data if needed
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });
    </script>
@endsection
