{{-- <x-app-layout> --}}
@extends('metronic-layout')

    <main class="main-content">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <div class="row mt-n6 mb-6">
                <div class="col-lg-12 col-sm-6">
                    <div class="card blur border border-white mb-4 shadow-xs">
                        <div class="card-body p-4">
                            <p class="text-sm mb-1">Sekarang anda memiliki ... SKS</p>
                            <p class="text-sm mb-1">Anda belum mendaftar kegiatan KKN. Silahkan mendaftar kegiatan KKN yang sedang dibuka dibawah ini.</p>
                            <!-- <h3 class="mb-0 font-weight-bold">$8,093.00</h3> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Kegiatan KKN Universitas Syiah Kuala</h6>
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
                                                <a href="{{ route('daftar') }}" class="btn btn-primary px-3 mb-0">Daftar</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <x-app.footer /> --}}
        </div>
    </main>

{{-- </x-app-layout> --}}
