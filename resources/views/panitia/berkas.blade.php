@extends('metronic-layout')
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('layouts.header-panitia')
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('layouts.sidebar')
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Daftar Kegiatan KKN</h1>
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
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Filter menu-->
                                    <div class="m-0">
                                        <!--begin::Menu toggle-->
                                        <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>Filter</a>
                                        <!--end::Menu toggle-->
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_660638501f356">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fw-semibold">Status:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div>
                                                        <select class="form-select form-select-solid" multiple="multiple" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select option" data-dropdown-parent="#kt_menu_660638501f356" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1">Approved</option>
                                                            <option value="2">Pending</option>
                                                            <option value="2">In Process</option>
                                                            <option value="2">Rejected</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fw-semibold">Member Type:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <div class="d-flex">
                                                        <!--begin::Options-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" value="1" />
                                                            <span class="form-check-label">Author</span>
                                                        </label>
                                                        <!--end::Options-->
                                                        <!--begin::Options-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                            <span class="form-check-label">Customer</span>
                                                        </label>
                                                        <!--end::Options-->
                                                    </div>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fw-semibold">Notifications:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Switch-->
                                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                        <label class="form-check-label">Enabled</label>
                                                    </div>
                                                    <!--end::Switch-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Menu 1-->
                                    </div>
                                    <!--end::Filter menu-->
                                    <!--begin::Secondary button-->
                                    <!--end::Secondary button-->
                                    <!--begin::Primary button-->
                                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
                                    <!--end::Primary button-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
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
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <!--begin::Copyright-->
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">Panita Kuliah Kerja Nyata (KKN) 2024&copy;</span>
                                <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Universitas Syiah Kuala - Developed by UPT. Teknologi Informasi dan Komunikasi.</a>
                            </div>
                            <!--end::Copyright-->
                        </div>
                        <!--end::Footer container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/custom/apps/user-management/users/list/table.js"></script>
    <script src="assets/js/custom/apps/user-management/users/list/export-users.js"></script>
    <script src="assets/js/custom/apps/user-management/users/list/add.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
