{{-- <x-app-layout> --}}
@extends('metronic-layout')

    <main class="main-content">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <div class="row mt-n6 mb-6">
                <div class="col">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <!-- <h6 class="font-weight-semibold text-lg mb-0">Daftar Kegiatan KKN Universitas Syiah Kuala</h6> -->
                                    <!-- <p class="text-sm mb-sm-0 mb-2">These are details about the last transactions</p> -->
                                </div>
                            </div>
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <h6 class="font-weight-semibold text-lg mb-0">Profil</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="pt-0 card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="nama_kkn">Nama : {{ session('nama') }}</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="masa_kegiatan">Fakultas / Nama Unit : {{ session('fakultas') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="masa_pendaftaran">NIP/NIK : {{ session('nip') }}</label>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Status : </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tahun_ajaran">NIP/NIK Korcam : </label>
                                    </div>

                                    <div class="col-6">
                                        <label for="semester">Nama Korcam : </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-bottom pb-0">
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <a href="" class="btn btn-primary px-3 mb-0">Unduh Panduan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-xs border mt-5">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <!-- <h6 class="font-weight-semibold text-lg mb-0">Daftar Kegiatan KKN Universitas Syiah Kuala</h6> -->
                                    <!-- <p class="text-sm mb-sm-0 mb-2">These are details about the last transactions</p> -->
                                </div>
                            </div>
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Kelompok yang Anda Bimbing</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Nama / Periode</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Jenis</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Lokasi</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Masa Kegiatan</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kkns as $kkn)
                                        <tr>
                                            <td class="mb-0 text-sm">{{ $kkn->masa_periode }}</td>
                                            <td class="text-center mb-0 text-sm">{{ $kkn->jenisKkn->kategori }}</td>
                                            <td class="text-center mb-0 text-sm">{{ $kkn->lokasi }}</td>
                                            <td class="mb-0 text-sm">{{ $kkn->ket }}</td>
                                            {{-- <td class="mb-0 text-sm">{{ $kkn->status }}</td> --}}
                                            @if($kkn->status === 1)
                                                <td><span class="badge badge-primary">Aktif</span></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('daftar') }}" class="btn btn-primary px-3 mb-0">Detail</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-xs border mt-5">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <!-- <h6 class="font-weight-semibold text-lg mb-0">Daftar Kegiatan KKN Universitas Syiah Kuala</h6> -->
                                    <!-- <p class="text-sm mb-sm-0 mb-2">These are details about the last transactions</p> -->
                                </div>
                            </div>
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Kelompok dibawah Koordinator Kecamatan</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Nama / Periode</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Jenis</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Lokasi</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Masa Kegiatan</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="mb-0 text-sm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

{{-- </x-app-layout> --}}
