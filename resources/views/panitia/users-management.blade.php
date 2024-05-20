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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Akun Panitia</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Akun Panitia</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Daftar Akun Panitia</li>
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
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
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
                            {{-- <a href="{{ route('kkn.create') }}"> --}}
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_permission">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>Tambah Akun</button>
                            {{-- </a> --}}
                            <!--end::Button-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px text-center">NIK/NIP</th>
                                    <th class="min-w-250px text-center">Nama</th>
                                    <th class="min-w-125px text-center">No HP</th>
                                    <th class="min-w-125px text-center">Hak Akses</th>
                                    <th class="min-w-125px text-center">Terakhir Login</th>
                                    <th class="min-w-125px text-center">Keterangan</th>
                                    <th class="min-w-125px text-center">Status</th>
                                    <th class="text-end min-w-100px text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom">{{ $user->nip }}</td>
                                        <td class="align-middle bg-transparent border-bottom">{{ $user->nama }}</td>
                                        <td class="align-middle bg-transparent border-bottom">{{ $user->nohp }}</td>
                                        <td class="align-middle bg-transparent border-bottom text-center">{{ $user->level }}</td>
                                        <td class="align-middle bg-transparent border-bottom">{{ $user->last_signed_in }}</td>
                                        <td class="align-middle bg-transparent border-bottom">{{ $user->keterangan }}</td>
                                        {{-- <td class="align-middle bg-transparent border-bottom">{{ $user->status }}</td> --}}
                                        @if ($user->status == "1")
                                            <td class="text-center"><span class="badge badge-success">Aktif</span></td>
                                            <td class="text-center">
                                                <a href=""><i class="fas fa-cog"></i></a>
                                                <a href="" class="nonaktif"><i class="fas fa-ban"></i></a>
                                            </td>
                                        @else
                                            <td class="text-center"><span class="badge badge-danger">Nonaktif</span></td>
                                            <td class="text-center">
                                                <a href=""><i class="fas fa-cog"></i></a>
                                                <a href="" class="aktif"><i class="fas fa-check"></i></a>
                                            </td>
                                        @endif
                                        {{-- <td class="text-center align-middle bg-transparent border-bottom">
                                            <a href="#"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    <!--begin::Modal - Add permissions-->
    <div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Akun Panitia KKN Baru</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_permission_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">NIP</span>
                            </label>
                            <input class="form-control form-control-solid" placeholder="" name="nip" />
                            <label class="fs-6 fw-semibold form-label mb-2 mt-2">
                                <span class="required">Nomor Handphone</span>
                            </label>
                            <input class="form-control form-control-solid" placeholder="" name="nohp" />
                            <label class="fs-6 fw-semibold form-label mb-2 mt-2">
                                <span class="required">Hak Akses</span>
                            </label>
                            <input class="form-control form-control-solid" placeholder="" name="level" />
                            <label class="fs-6 fw-semibold form-label mb-2 mt-2">
                                <span class="required">Keterangan</span>
                            </label>
                            <input class="form-control form-control-solid" placeholder="" name="keterangan" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Discard</button>
                            <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add permissions-->
@endsection
