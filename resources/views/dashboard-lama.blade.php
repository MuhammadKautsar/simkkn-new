<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Hello, Noah</h3>
                            <p class="mb-0">Apps you might like!</p>
                        </div>
                        <button type="button"
                            class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                            <span class="btn-inner--icon">
                                <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                    <span class="visually-hidden">New</span>
                                </span>
                            </span>
                            <span class="btn-inner--text">Messages</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                            <span class="btn-inner--text">Sync</span>
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Kegiatan KKN Universitas Syiah Kuala</h6>
                                    <!-- <p class="text-sm mb-sm-0 mb-2">These are details about the last transactions</p> -->
                                </div>
                                <!-- <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                        View report
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="d-block me-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Download</span>
                                    </button>
                                </div> -->
                            </div>
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <a href="{{ route('kkn.create') }}" class="btn btn-primary px-3 mb-0">Tambah Kegiatan KKN Baru</a>
                                    <!-- <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable1"
                                        autocomplete="off" checked>
                                    <label class="btn btn-white px-3 mb-0" for="btnradiotable1">All</label>
                                    <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable2"
                                        autocomplete="off">
                                    <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Monitored</label>
                                    <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable3"
                                        autocomplete="off">
                                    <label class="btn btn-white px-3 mb-0" for="btnradiotable3">Unmonitored</label> -->
                                </div>
                                <div class="input-group w-sm-25 ms-auto">
                                    <span class="input-group-text text-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search">
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
                                                <td class="text-center"><span class="badge badge-primary">Aktif</span></td>
                                                <td>
                                                    <a href="{{ route('kkn.edit', ['id' => $kkn->id]) }}" class="konfigurasi_kkn"><i class="fas fa-cog"></i></a>
                                                    {{-- @if(auth()->user()->level !== "1")
                                                        <a href="" data-value="{{ $kkn->id }}" class="kkn_selesai"><i class="fas fa-check"></i></a> <a href="" class="kkn_nonaktif" data-value="{{ $kkn->id }}"><i class="fas fa-ban"></i></a>
                                                    @endif --}}
                                                </td>
                                            @elseif ($kkn->status === 2)
                                                <td class="text-center"><span class="badge badge-danger">Nonaktif</span></td>
                                                <td>
                                                    <a href="" data-value="{{ $kkn->id }}" class="konfigurasi_kkn"><i class="fas fa-cog"></i></a>
                                                </td>
                                            @else
                                                <td class="text-center"><span class="badge badge-success">Selesai</span></td>
                                                <td>
                                                    <a href="" data-value="{{ $kkn->id }}" class="konfigurasi_kkn"><i class="fas fa-cog"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                Showing {{$kkns->firstItem()}} to {{$kkns->lastItem()}} out of {{$kkns->total()}} items
                                <div class="ms-auto">
                                    {{ $kkns->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
