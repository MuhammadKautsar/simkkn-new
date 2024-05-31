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
                        Monitoring Dokumen Kegiatan KKN</h1>
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
                        <li class="breadcrumb-item text-muted">Monitoring Dokumen Kegiatan KKN</li>
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
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3" href="{{ route('kkn.konfigurasi_bataswaktu', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-calendar fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> Batasan Waktu</a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3 active" href="{{ route('kkn.konfigurasi_monitoring', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-monitor-mobile fs-2">
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
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Dokumen Dosen</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <div class="card-header mt-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1 me-5">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-permissions-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13"
                                            placeholder="Search" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-light-primary">
                                        <i class="ki-duotone ki-cloud-download fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Unduh Data Monitoring Berkas Dosen (Excel)
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Kelompok</th>
                                            <th class="min-w-125px">Profil Desa</th>
                                            <th class="min-w-125px">Laporan Survey Dosen</th>
                                            <th class="min-w-125px">Laporan Monev</th>
                                            <th class="min-w-125px">Nilai Akhir DPL</th>
                                            <th class="min-w-125px">Nilai Akhir Geuchik</th>
                                            <th class="min-w-125px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="mb-0 text-sm"></td>
                                            <td class="mb-0 text-sm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-start">
                                    <!--begin::Button-->
                                    <button class="btn btn-primary">
                                        <span class="indicator-label">Unduh Semua Berkas Dosen</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-1">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Unduh Berkas Dosen</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-5">
                                <!--begin::Form-->
                                <form class="form" action="/kkn/{{ $kkn->id }}/update" method="POST">
                                    @csrf
                                    <!--begin::Row-->
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Dari Kelompok:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required type="number" class="form-control form-control-solid"
                                                    name="nama_kkn" />
                                                <!--end::Input-->
                                                @error('masa_periode')
                                                    <span class="error-message text-danger">{{ $message }}</span>
                                                @enderror
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
                                                    <span>Sampai Kelompok:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" class="form-control form-control-solid"
                                                    name="masa_kkn" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Separator-->
                                    <div class="separator mb-6"></div>
                                    <!--end::Separator-->
                                    <!--begin::Action buttons-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <button class="btn btn-primary">
                                            <span class="indicator-label">Unduh Berkas</span>
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
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Dokumen Mahasiswa</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <div class="card-header mt-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1 me-5">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-permissions-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13"
                                            placeholder="Search" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-light-primary">
                                        <i class="ki-duotone ki-cloud-download fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Unduh Data Monitoring Berkas Peserta (Excel)
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">NIM</th>
                                            <th class="min-w-125px">Nama</th>
                                            <th class="min-w-125px">Nama DPL</th>
                                            <th class="min-w-125px">Proposal</th>
                                            <th class="min-w-125px">Logbook</th>
                                            <th class="min-w-125px">Laporan Akhir</th>
                                            <th class="min-w-125px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="mb-0 text-sm"></td>
                                            <td class="mb-0 text-sm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-start">
                                    <!--begin::Button-->
                                    <button class="btn btn-primary">
                                        <span class="indicator-label">Unduh Semua Berkas Peserta</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Dokumen Mahasiswa Luar USK</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <div class="card-header mt-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1 me-5">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-permissions-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13"
                                            placeholder="Search" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-light-primary">
                                        <i class="ki-duotone ki-cloud-download fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Unduh Data Monitoring Berkas Peserta (Excel)
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">NIM</th>
                                            <th class="min-w-125px">Nama</th>
                                            <th class="min-w-125px">Universitas</th>
                                            <th class="min-w-125px">Nama DPL</th>
                                            <th class="min-w-125px">Proposal</th>
                                            <th class="min-w-125px">Logbook</th>
                                            <th class="min-w-125px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="mb-0 text-sm"></td>
                                            <td class="mb-0 text-sm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-start">
                                    <!--begin::Button-->
                                    <button class="btn btn-primary">
                                        <span class="indicator-label">Unduh Semua Berkas Peserta</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-1">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Unduh Berkas Mahasiswa</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-5">
                                <!--begin::Form-->
                                <form class="form" action="/kkn/{{ $kkn->id }}/update" method="POST">
                                    @csrf
                                    <!--begin::Row-->
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Dari Kelompok:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required type="number" class="form-control form-control-solid"
                                                    name="nama_kkn" />
                                                <!--end::Input-->
                                                @error('masa_periode')
                                                    <span class="error-message text-danger">{{ $message }}</span>
                                                @enderror
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
                                                    <span>Sampai Kelompok:</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" class="form-control form-control-solid"
                                                    name="masa_kkn" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Separator-->
                                    <div class="separator mb-6"></div>
                                    <!--end::Separator-->
                                    <!--begin::Action buttons-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <button class="btn btn-primary">
                                            <span class="indicator-label">Unduh Berkas</span>
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
@endsection