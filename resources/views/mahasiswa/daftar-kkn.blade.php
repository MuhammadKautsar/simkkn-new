<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
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
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Daftar KKN</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="nama_kkn">Nama Mahasiswa:</label>
                                        <input type="text" name="nama_kkn" id="nama_kkn" class="form-control" required>
                                        @error('nama_kkn')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="masa_kegiatan">NPM:</label>
                                        <input type="text" name="masa_kegiatan" id="masa_kegiatan" class="form-control" required>
                                        @error('masa_kegiatan')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label for="jenis_kkn">Alamat</label>
                                    <input type="number" name="jenis_kkn" id="jenis_kkn" placeholder="" class="form-control" required>
                                    @error('jenis_kkn')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="masa_pendaftaran">Tempat lahir:</label>
                                        <input type="text" name="masa_pendaftaran" id="masa_pendaftaran" placeholder="" class="form-control" required>
                                        @error('masa_pendaftaran')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="">Tanggal lahir</label>
                                        <input type="text" name="" id="" placeholder="" class="form-control">
                                        @error('')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tahun_ajaran">Nomor hp:</label>
                                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" placeholder="" class="form-control" required>
                                        @error('tahun_ajaran')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="semester">Nomor hp ayah:</label>
                                        <input type="text" name="semester" id="semester" placeholder="" class="form-control" required>
                                        @error('semester')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label for="kode_kkn">jumlah sks:</label>
                                    <input type="text" name="kode_kkn" id="kode_kkn" placeholder="" class="form-control" required>
                                    @error('kode_kkn')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <label for="kuota_peserta">Upload Berkas</label>
                                    <input type="file" name="kuota_peserta" id="kuota_peserta" placeholder="" class="form-control" required>
                                    @error('kuota_peserta')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <label for="kuota_peserta">Memenuhi Persyaratan :</label>
                                    <label>
                                        <input type="checkbox" name="terms" id="terms" required> Mencapai 100 sks
                                    </label>
                                </div>
                                <button type="submit" class="mt-6 mb-0 btn btn-success btn-sm float-end">Daftar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

</x-app-layout>
