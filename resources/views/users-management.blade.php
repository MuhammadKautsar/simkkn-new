{{-- <x-app-layout> --}}
    @extends('metronic-layout')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Daftar Panitia</h5>
                                    <!-- <p class="mb-0 text-sm">
                                        Here you can manage users.
                                    </p> -->
                                </div>
                                <div class="col-6 text-end">
                                    <!-- <a href="#" class="btn btn-dark btn-primary">
                                        <i class="fas fa-user-plus me-2"></i> Tambah Panitia
                                    </a> -->
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fas fa-user-plus me-2"></i> Tambah Panitia
                                    </button>
                                </div>
                            </div>
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
                            <table class="table text-secondary text-center">
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
        <x-app.footer />
    </main>

{{-- </x-app-layout> --}}

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

<script src="/assets/js/plugins/datatables.js"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true,
        columns: [{
            select: [2, 6],
            sortable: false
        }]
    });
</script>
