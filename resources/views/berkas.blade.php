{{-- <x-app-layout> --}}
    @extends('metronic-layout')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        {{-- @extends('layouts.sidebar') --}}
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('kkn.store') }}" method="POST">
                @csrf
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
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-12 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Pengumuman</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row p-2">
                                    <label for="pengumuman">Pengumuman Halaman Utama</label>
                                    <textarea type="text" name="pengumuman" id="pengumuman" placeholder="" class="form-control" rows="5"></textarea>
                                    @error('pengumuman')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="mt-2 mb-0 btn btn-success btn-sm float-end">Submit</button>
                            </div>
                        </div>
                        <div class="card mt-5" id="basic-info">
                            <div class="card-header">
                                <h5>Berkas Pengumuman</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row p-2">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" placeholder="Unggah Berkas Panduan KKN" class="form-control">
                                    @error('judul')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" name="kategori" id="kategori" placeholder="" class="form-control">
                                    @error('kategori')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <label for="berkas">Berkas</label>
                                    <input type="file" name="berkas" id="berkas" placeholder="" class="form-control">
                                    @error('berkas')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="mt-2 mb-0 btn btn-success btn-sm float-end">Submit</button>
                            </div>
                            <div class="row justify-content-center">
                                <div class="">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert" id="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert" id="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Judul Pengumuman</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Nama berkas</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Kategori</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">Tanggal Unggah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($users as $user) --}}
                                        <tr>
                                            {{-- <td class="align-middle bg-transparent border-bottom">{{ $user->nip }}</td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->nama }}</td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->level }}</td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->keterangan }}</td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->nohp }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <a href="#"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                            </td> --}}
                                        </tr>
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-3 px-3 d-flex align-items-center">
                                {{-- Showing {{$users->firstItem()}} to {{$users->lastItem()}} out of {{$users->total()}} items --}}
                                <div class="ms-auto">
                                    {{-- {{ $users->links() }} --}}
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5" id="basic-info">
                            <div class="card-header">
                                <h5>Berkas lainnya</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row p-2">
                                    <label for="panduan">Berkas Panduan KKN</label>
                                    <input type="file" name="panduan" id="panduan" placeholder="Unggah Berkas Panduan KKN" class="form-control">
                                    @error('panduan')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <label for="jadwal">Berkas Jadwal KKN</label>
                                    <input type="file" name="jadwal" id="jadwal" placeholder="" class="form-control">
                                    @error('jadwal')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <label for="logbook">Format Logbook</label>
                                    <input type="file" name="logbook" id="logbook" placeholder="" class="form-control">
                                    @error('logbook')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="mt-2 mb-0 btn btn-success btn-sm float-end">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

{{-- </x-app-layout> --}}
