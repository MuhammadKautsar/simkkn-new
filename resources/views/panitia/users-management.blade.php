@extends('layouts.panitia-layout')\

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow-xs border">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center mb-3">
                    <div>
                        <h6 class="font-weight-semibold text-lg mb-0">Jenis KKN Universitas Syiah Kuala</h6>
                        <!-- <p class="text-sm mb-sm-0 mb-2">These are details about the last transactions</p> -->
                    </div>
                </div>
                <div class="pb-3 d-sm-flex align-items-center">
                    <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <a href="{{ route('kkn.create') }}" class="btn btn-primary px-3 mb-0">Tambah Jenis KKN Baru</a>
                    </div> -->
                    <button type="button" class="btn btn-primary px-3 mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-user-plus me-2"></i> Tambah Panitia
                    </button>
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
                        <thead>
                            <tr>
                                <th
                                    class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    NIP</th>
                                <th
                                    class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Nama</th>
                                {{-- <th
                                    class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Level</th> --}}
                                <th
                                    class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Keterangan</th>
                                <th
                                    class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    No HP</th>
                                <th
                                    class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="align-middle bg-transparent border-bottom">{{ $user->nip }}</td>
                                <td class="align-middle bg-transparent border-bottom">{{ $user->nama }}</td>
                                {{-- <td class="align-middle bg-transparent border-bottom">{{ $user->level }}</td> --}}
                                <td class="align-middle bg-transparent border-bottom">{{ $user->keterangan }}</td>
                                <td class="align-middle bg-transparent border-bottom">{{ $user->nohp }}</td>
                                <td class="text-center align-middle bg-transparent border-bottom">
                                    <a href="#"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-3 px-3 d-flex align-items-center">
                    Showing {{$users->firstItem()}} to {{$users->lastItem()}} out of {{$users->total()}} items
                    <div class="ms-auto">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Panitia</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/users-management/store" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">NIP</label>
                <input name="nip" type="number" class="form-control @error('nip') is-invalid @enderror" id="exampleInputEmail1">
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Level</label>
                <select type="text" name="level" id="level" placeholder="" class="form-select" required>
                      <option value="Panitia">Panitia</option>
                </select>
                @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
