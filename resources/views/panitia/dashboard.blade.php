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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Beranda</h1>
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
                        <li class="breadcrumb-item text-muted">Daftar Kegiatan KKN</li>
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
                            <a href="{{ route('kkn.create') }}">
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_permission">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>Tambah Kegiatan KKN Baru</button>
                            </a>
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
                                    <th class="min-w-125px text-center">Nama / Periode</th>
                                    <th class="min-w-250px text-center">Jenis</th>
                                    <th class="min-w-125px text-center">Lokasi</th>
                                    <th class="min-w-125px text-center">Masa Kegiatan</th>
                                    <th class="min-w-125px text-center">Status</th>
                                    <th class="text-end min-w-100px text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($kkns as $kkn)
                                <tr>
                                    @if ($kkn->nama_kkn != null)
                                        <td class="mb-0 text-sm">{{ $kkn->nama_kkn }}</td>
                                    @else
                                        <td class="mb-0 text-sm">{{ $kkn->masa_periode }}</td>
                                    @endif
                                    @if ($kkn->jenis_kkn == '0')
                                        <td class="text-center mb-0 text-sm">Tidak Ada</td>
                                    @else
                                        <td class="text-center mb-0 text-sm">{{ $kkn->jenisKkn->kategori }}</td>
                                    @endif
                                    @if ($kkn->lokasi != '0')
                                        <td class="text-center mb-0 text-sm">{{ $kkn->lokasi }}</td>
                                    @elseif (count($kkn->lokasi_mappings) == 0)
                                        <td class="text-center mb-0 text-sm">-</td>
                                    @else
                                        <td class="text-center mb-0 text-sm">
                                            @php
                                                $count = count($kkn->lokasi_mappings);
                                                $i = 0;
                                            @endphp
                                            @foreach ($kkn->lokasi_mappings as $lokasi)
                                                {{ $lokasi->province ? ucwords(strtolower($lokasi->province->name)) : 'N/A' }} - {{ $lokasi->regency ? ucwords(strtolower($lokasi->regency->name)) : 'N/A' }}
                                                @php $i++; @endphp
                                                @if ($i < $count)
                                                    #
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    @if ($kkn->ket == null)
                                        <td class="mb-0 text-sm">{{ $kkn->masa_periode }}</td>
                                    @else
                                        <td class="mb-0 text-sm">{{ $kkn->ket }}</td>
                                    @endif
                                    @if($kkn->status === 1)
                                        <td class="text-center"><span class="badge badge-primary">Aktif</span></td>
                                        <td class="text-center">
                                            @if (session('level') !== "1")
                                                <a href="{{ route('kkn.edit', ['id' => $kkn->id]) }}" class="konfigurasi_kkn"><i class="fas fa-cog"></i></a>
                                                <a href="" data-value="{{ $kkn->id }}" class="kkn_selesai"><i class="fas fa-check"></i></a>
                                                <a href="" data-value="{{ $kkn->id }}" class="kkn_nonaktif" ><i class="fas fa-ban"></i></a>
                                            @endif
                                        </td>
                                    @elseif ($kkn->status === 2)
                                        <td class="text-center"><span class="badge badge-danger">Nonaktif</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('kkn.edit', ['id' => $kkn->id]) }}" class="konfigurasi_kkn"><i class="fas fa-cog"></i></a>
                                        </td>
                                    @else
                                        <td class="text-center"><span class="badge badge-success">Selesai</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('kkn.edit', ['id' => $kkn->id]) }}" class="konfigurasi_kkn"><i class="fas fa-cog"></i></a>
                                        </td>
                                    @endif
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

    <script>
        var BASE_URL = "{{ url('/') }}/";

        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.kkn_selesai, .kkn_nonaktif');

            buttons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const id_periode = this.dataset.value;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let url = '';

                    if (this.classList.contains('kkn_selesai')) {
                        url = BASE_URL + "Kkn/kkn_selesai";
                    } else if (this.classList.contains('kkn_nonaktif')) {
                        url = BASE_URL + "Kkn/kkn_nonaktif";
                    }

                    Swal.fire({
                        title: 'Apakah Anda yakin ingin melakukan perubahan ini?',
                        text: "Data yang telah diubah tidak bisa dikembalikan",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, ubah!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                data: { id_periode: id_periode },
                                cache: false,
                                dataType: "json",
                                success: function (data) {
                                    Swal.fire('Sukses!', data.message, 'success').then(() => {
                                        // Reload the page to reflect changes
                                        location.reload();
                                    });
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    Swal.fire('Error!', "Status: " + textStatus + " Error: " + errorThrown, 'error');
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
