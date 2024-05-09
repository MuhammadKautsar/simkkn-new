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
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Konfigurasi KKN Baru</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Management</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">KKN</li>
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
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert" id="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" id="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h5>Konfigurasi KKN</h5>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <form action="{{ route('kkn.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="nama_kkn">Nama Kegiatan/Periode KKN:</label>
                                <input type="text" name="nama_kkn" id="nama_kkn" class="form-control" required>
                                @error('nama_kkn')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="masa_kegiatan">Masa Kegiatan KKN:</label>
                                <input type="text" name="masa_kegiatan" id="masa_kegiatan" class="form-control" required>
                                @error('masa_kegiatan')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row p-2">
                            <label for="jenis_kkn">Jenis KKN</label>
                            <select type="number" name="jenis_kkn" id="jenis_kkn" placeholder="" class="form-select" required>
                                <option disabled selected>- Pilih -</option>
                                @foreach ($jenis_kkns as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                            @error('jenis_kkn')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="masa_pendaftaran">Masa Pendaftaran Online KKN:</label>
                                <input type="text" name="masa_pendaftaran" id="masa_pendaftaran" placeholder="" class="form-control" required>
                                @error('masa_pendaftaran')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for=""></label>
                                <input type="text" name="" id="" placeholder="" class="form-control">
                                @error('')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="tahun_ajaran">Tahun Ajaran:</label>
                                <input type="text" name="tahun_ajaran" id="tahun_ajaran" placeholder="" class="form-control" required>
                                @error('tahun_ajaran')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="semester">Semester:</label>
                                <select type="text" name="semester" id="semester" placeholder="" class="form-select" required>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                                @error('semester')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row p-2">
                            <label for="kode_kkn">Kode Kegiatan KKN:</label>
                            <input type="text" name="kode_kkn" id="kode_kkn" placeholder="" class="form-control" required>
                            @error('kode_kkn')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row p-2">
                            <label for="minimal_sks">Minimal SKS:</label>
                            <input type="number" name="minimal_sks" id="minimal_sks" placeholder="" class="form-control" required>
                            @error('minimal_sks')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row p-2">
                            <label for="kuota_peserta">Kuota Peserta KKN:</label>
                            <input type="number" name="kuota_peserta" id="kuota_peserta" placeholder="" class="form-control" required>
                            @error('kuota_peserta')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="mt-6 mb-0 btn btn-success btn-sm float-end">Save</button>
                    </form>
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

@endsection
