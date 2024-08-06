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
                        Konfigurasi Lokasi Kegiatan KKN Baru</h1>
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
                        <li class="breadcrumb-item text-muted">Konfigurasi Lokasi Kegiatan KKN Baru</li>
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
                                            <a class="btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-4 mx-3 active" href="{{ route('kkn.konfigurasi_lokasi', ['id' => $kkn->id]) }}"><i class="ki-duotone ki-geolocation fs-2">
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
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Input Provinsi dan Kabupaten</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-5">
                                <form id="form_lokasi">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-3">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Provinsi:</span>
                                        </label>
                                        <!--end::Label-->
                                        <input name="id_periode" id="id_periode" style="display: none" value="{{ $kkn->id }}" >
                                        <select id="provinsi" required class="provinsi form-select form-select-solid" name="provinsi" data-target="#kabupaten">
                                            <option value="" disabled selected>Pilih Provinsi</option>
                                                @foreach($provinsi as $prov)
                                                    <option value="{{ $prov->id }}">{{ ucwords(strtolower($prov->name)) }}</option>
                                                @endforeach
                                        </select>
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Kabupaten:</span>
                                        </label>
                                        <!--end::Label-->
                                        <select id="kabupaten" required class="kabupaten form-select form-select-solid" name="kabupaten">
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->

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
                            </div>
                        </div>

                        <div class="row">
                            <!--begin::Left Card-->
                            <div class="col-md-6">
                                <div class="card card-flush mt-8">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Input Kecamatan</span>
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <div class="card-body pt-5">
                                        <form id="form_kecamatan">
                                            @csrf
                                            <!--begin::Input group-->
                                            <input name="id_periode" id="id_periode" style="display: none" value="{{ $kkn->id }}" >
                                            <div class="fv-row mb-3">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Pilih Kabupaten:</span>
                                                </label>
                                                <select id="kabupaten" required class="kabupaten form-select form-select-solid" name="kabupaten" data-target="#kecamatan">
                                                    <option value="" disabled selected>Pilih Kabupaten</option>
                                                    @foreach ($kabupaten_data as $dk)
                                                        <option value="{{ $dk['id'] }}">{{ $dk['kabupaten'] }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Nama Kecamatan:</span>
                                                </label>
                                                <select id="kecamatan" required class="kecamatan form-select form-select-solid" name="nama_kecamatan">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Nama Camat:</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" name="nama_camat" value="-" />
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>No Handphone Camat:</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" name="no_hp_camat" value="-" />
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Nama Koordinator Kecamatan:</span>
                                                </label>
                                                <select id="kt_ecommerce_select2_province" required class="form-select form-select-solid" name="korcam">
                                                    @if (!$data['data_korcam'])
                                                        <option value="" disabled selected>Belum ada korcam yang diinput</option>
                                                    @else
                                                        <option value="" disabled selected>Pilih Korcam</option>
                                                        @foreach ($data['data_korcam'] as $k)
                                                            <option value="{{ $k->id }}">{{ ucwords(strtolower($k->nama)) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Action buttons-->
                                            <div class="d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Action buttons-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--end::Left Card-->

                            <!--begin::Right Card-->
                            <div class="col-md-6">
                                <div class="card card-flush mt-8">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Input Desa</span>
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <div class="card-body pt-5">
                                        <form id="form_desa">
                                            @csrf
                                            <!--begin::Input group-->
                                            <input name="id_periode" id="id_periode" style="display: none" value="{{ $kkn->id }}" >
                                            <div class="fv-row mb-3">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Pilih Kecamatan:</span>
                                                </label>
                                                <select id="kecamatan" required class="kecamatan form-select form-select-solid" name="kecamatan" data-target="#desa">
                                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                                    @foreach ($kecamatan_data as $dk)
                                                        <option value="{{ $dk['kd_kecamatan'] }}">{{ $dk['nama_kecamatan'] }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Nama Desa:</span>
                                                </label>
                                                <select id="desa" required class="desa form-select form-select-solid" name="nama_desa">
                                                    <option value="">Pilih Desa</option>
                                                </select>
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Nama Kepala Desa:</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" name="nama_kepala_desa" value="-" />
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>No Handphone Kepala Desa:</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" name="no_kepala_desa" value="-" />
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Nama DPL:</span>
                                                </label>
                                                <select id="kt_ecommerce_select2_province" required class="form-select form-select-solid" name="dpl">
                                                    @if (!$data['data_dpl'])
                                                        <option value="" disabled selected>Belum ada korcam yang diinput</option>
                                                    @else
                                                        <option value="" disabled selected>Pilih Korcam</option>
                                                        @foreach ($data['data_dpl'] as $d)
                                                            <option value="{{ $d->id }}">{{ ucwords(strtolower($d->nama)) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Action buttons-->
                                            <div class="d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Action buttons-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--end::Right Card-->
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Daftar Desa</span>
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
                                    <a href="{{ route('export.lokasi', ['type' => 'desa', 'id_periode' => $kkn->id]) }}" type="button" class="btn btn-light-primary">
                                        <i class="ki-duotone ki-cloud-download fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Unduh Data Penempatan Desa dan Pembagian DPL (Excel)
                                    </a>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Kecamatan</th>
                                            <th class="min-w-125px">Desa</th>
                                            <th class="min-w-125px">Nama Kepala Desa</th>
                                            <th class="min-w-125px">No. Handphone</th>
                                            <th class="min-w-125px">Korcam</th>
                                            <th class="min-w-125px">DPL</th>
                                            <th class="min-w-125px">Kode Kelompok</th>
                                            <th class="text-end min-w-100px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($desa_data as $data)
                                            <tr>
                                                <td>{{ $data['nama_kecamatan'] }}</td>
                                                <td>{{ $data['nama_desa'] }}</td>
                                                <td>{{ $data['nama_kepala_desa'] }}</td>
                                                <td>{{ $data['no_kepala_desa'] }}</td>
                                                <td>{{ $data['nama_korcam'] }}</td>
                                                <td>{{ $data['nama_dpl'] }}</td>
                                                <td>{{ $data['kd_kelompok'] }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('hapus_data', ['id' => $data['id']]) }}" class="delete-data" data-val="{{ $data['id'] }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="" data-toggle="modal" data-target="#korcamModal" data-id ='.$data->id.' data-kecamatan ="'.$data_column["nama_kecamatan"].'" class="ganti-korcam"><i class="fas fa-cog"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Daftar Kecamatan</span>
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
                                        <input type="text" data-kt-user-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13"
                                            placeholder="Search" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <a href="{{ route('export.lokasi', ['type' => 'kecamatan', 'id_periode' => $kkn->id]) }}" type="button" class="btn btn-light-primary">
                                        <i class="ki-duotone ki-cloud-download fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Unduh Data Penempatan Kecamatan (Excel)
                                    </a>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_table_users">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Provinsi - Kabupaten</th>
                                            <th class="min-w-125px">Kecamatan</th>
                                            <th class="min-w-125px">Nama Camat</th>
                                            <th class="min-w-125px">No. Handphone</th>
                                            <th class="min-w-125px">Koordinator Kecamatan</th>
                                            <th class="text-end min-w-100px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($kecamatan_data as $data)
                                            <tr>
                                                <td>{{ $data['provinsi'] }}</td>
                                                <td>{{ $data['nama_kecamatan'] }}</td>
                                                <td>{{ $data['nama_camat'] }}</td>
                                                <td>{{ $data['no_hp_camat'] }}</td>
                                                <td>{{ $data['nama_korcam'] }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('hapus_data', ['id' => $data['id']]) }}" class="delete-data" data-doc="kecamatan" data-val="{{ $data['id'] }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="" data-toggle="modal" data-target="#korcamModal" data-id ='.$data->id.' data-kecamatan ="'.$data_column["nama_kecamatan"].'" class="ganti-korcam"><i class="fas fa-cog"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card card-flush mt-8">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Daftar Provinsi dan Kabupaten</span>
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
                                    <a href="{{ route('export.lokasi', ['type' => 'kabupaten', 'id_periode' => $kkn->id]) }}" type="button" class="btn btn-light-primary">
                                        <i class="ki-duotone ki-cloud-download fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Unduh Data Penempatan Provinsi dan Kabupaten (Excel)
                                    </a>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Provinsi</th>
                                            <th class="min-w-125px">Kabupaten</th>
                                            <th class="text-end min-w-100px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($kabupaten_data as $data)
                                            <tr>
                                                <td>{{ $data['provinsi'] }}</td>
                                                <td>{{ $data['kabupaten'] }}</td>
                                                <td class="text-end">
                                                    @if ($data['status'])
                                                        <a href="{{ route('hapus_data', ['id' => $data['id']]) }}" class="delete-data" data-doc="kabupaten" data-val="{{ $data['id'] }}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <!-- ============================================================== -->
                            <!-- basic table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Daftar Provinsi dan Kabupaten</h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="regencies_table" class="table table-striped table-bordered provinsi" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Provinsi</th>
                                                        <th>Kabupaten</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Provinsi</th>
                                                        <th>Kabupaten</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end basic table  -->
                            <!-- ============================================================== -->
                        </div> --}}

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

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Setting up CSRF token for AJAX requests -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- Handling province change and fetching regencies -->
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
                    $.each(data, function (key, value) {
                        $(targetDropdown).append($('<option>').val(value.id).text(value.kabupaten));
                    });
                },
                error: function (error) {
                    console.error('Error:', error);
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
                    // $(targetDropdown).append($('<option>').val('').text('Pilih Kecamatan'));
                    $.each(data, function (key, value) {
                        $(targetDropdown).append($('<option>').val(value.id).text(value.kecamatan));
                    });
                }
            });
        });

        $('body').on('change', '.kecamatan', function () {
            var id_kecamatan = $(this).val();
            var targetDropdown = $(this).data('target');
            $.ajax({
                url: '/get-desa',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id_kecamatan: id_kecamatan
                },
                success: function (data) {
                    $(targetDropdown).empty();
                    $.each(data, function (key, value) {
                        $(targetDropdown).append($('<option>').val(value.id).text(value.desa));
                    });
                }
            });
        });
    });
</script>

<!-- Handling form submission for setting location -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('form_lokasi').addEventListener('submit', function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch('{{ route('kkn.set_lokasi') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === false) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message, // Update to use the message from the server
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Kabupaten berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                }
                // setRegenciesTable();
                // getAvailableRegencies();
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengirim data',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
        document.getElementById('form_kecamatan').addEventListener('submit', function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch('{{ route('kkn.set_kecamatan') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === false) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message, // Update to use the message from the server
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Kecamatan berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengirim data',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
        document.getElementById('form_desa').addEventListener('submit', function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch('{{ route('kkn.set_desa') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === false) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message, // Update to use the message from the server
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Desa berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengirim data',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    });
</script>

{{-- <script>
    $(document).ready(function() {
        setRegenciesTable();
    });

    function setRegenciesTable() {
        $.ajax({
            type: "POST",
            url: '{{ route('kkn.get_kabupaten_tersedia') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id_periode: $('#id_periode').val()
            },
            cache: false,
            success: function(data) {
                var t = $('#regencies_table').DataTable();
                t.clear();
                $.each(data, function(i, item) {
                    var aksi = '';
                    if(item.status && item.level){
                        aksi = '<td><a href="#" class="btn btn-danger delete-data" data-doc="kabupaten" data-val="' + item.id + '"><i class="fas fa-trash"></i></a></td>';
                    }
                    t.row.add([
                        item.provinsi,
                        item.kabupaten,
                        aksi
                    ]).draw(false);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    }
</script> --}}

{{-- <script>
    $(document).ready(function () {
    // getAvailableRegencies();
    // getAvailableDistricts();
    setRegenciesTable();
    // setDistrictsTable();
    // setVillagesTable();

    $(document).on('click', ".delete-data", function(event) {
        event.preventDefault();
        let id_data = $(this).data("val");
        let jenis_dokumen = $(this).data("doc");

        swal({
            title: 'Apakah Anda yakin ingin menghapus data ini?',
            text: "Menghapus kabupaten/kecamatan akan menghapus semua data di kabupaten/kecamatan tersebut",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/hapus-data",
                    data: {
                        id_data: id_data,
                        id_periode: id_periode,
                        jenis_doc: jenis_dokumen,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if(data.status){
                            swal(data.message, {
                                icon: "success",
                            });
                        } else {
                            swal(data.message, {
                                icon: "error",
                            });
                        }
                        setRegenciesTable();
                        // setDistrictsTable();
                        // setVillagesTable();
                        // getAvailableRegencies();
                        // getAvailableDistricts();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            }
        })
    });
});
</script> --}}

<script>
    $(document).ready(function () {
        $(document).on('click', ".delete-data", function(event) {
            event.preventDefault();
            let id_data = $(this).data("val");
            let jenis_dokumen = $(this).data("doc");
            let id_periode = $('#id_periode').val();
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                text: "Menghapus kabupaten/kecamatan akan menghapus semua data di kabupaten/kecamatan tersebut",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('hapus_data') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_data: id_data,
                            id_periode: id_periode,
                            jenis_doc: jenis_dokumen
                        },
                        success: function (data) {
                            if (data.status) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Status: ' + textStatus + ' Error: ' + errorThrown,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
