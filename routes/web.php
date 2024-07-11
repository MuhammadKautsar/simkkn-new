<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KknController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DaftarKknController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/sign-in', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'login'])
    ->middleware('guest');

// Route::post('/sign-in', [LoginController::class, 'prosesLogin'])
//     ->middleware('guest');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::middleware(['checkWebServiceSession'])->group(function () {
    Route::get('/beranda', [DaftarKknController::class, 'index'])->name('beranda');
    Route::get('/daftarkkn/{id}', [DaftarKknController::class, 'daftar'])->name('daftar');
    Route::post('/submit_registrasi', [DaftarKknController::class, 'submit_registrasi'])->name('submit_registrasi');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/cetak-pdf/{nim13}/{periode}', [MahasiswaController::class, 'cetakPdf'])->name('cetak.pdf');
    // Route::get('/cetak-pdf/{nim}', [MahasiswaController::class, 'generatePdf'])->name('cetak.pdf');
});

Route::prefix('dosen')->middleware(['checkWebServiceSession'])->group(function () {
    Route::get('beranda', [DosenController::class, 'index'])->name('dosen.beranda');
    Route::get('data_kelompok/{id_kelompok?}', [DosenController::class, 'data_kelompok'])->name('data_kelompok');

    Route::get('/download/{filename}', [DosenController::class, 'downloadPanduan'])->name('download.panduan');
});

Route::get('panitia/sign-in', [LoginController::class, 'panitia_index'])
    ->middleware('guest')
    ->name('panitia-sign-in');

Route::post('panitia/sign-in', [LoginController::class, 'panitia_login'])
    ->middleware('guest');

Route::middleware(['checkWebServiceSession'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard_panitia'])->name('dashboard');
    Route::get('/kkn/create', [KknController::class, 'create'])->name('kkn.create');
    Route::post('/kkn', [KknController::class, 'store'])->name('kkn.store');
    Route::get('/kkn/{id}/edit', [KknController::class, 'edit'])->name('kkn.edit');

    Route::put('/kkn/{id}/update', [KknController::class, 'update'])->name('kkn.update');

    Route::post('/Kkn/kkn_selesai', [KknController::class, 'kknSelesai'])->name('kkn.selesai');
    Route::post('/Kkn/kkn_nonaktif', [KknController::class, 'kknNonaktif'])->name('kkn.nonaktif');

    Route::get('/kkn/{id}/konfigurasi_dosen', [KknController::class, 'konfigurasi_dosen'])->name('kkn.konfigurasi_dosen');
    Route::get('/kkn/{id}/konfigurasi_lokasi', [KknController::class, 'konfigurasi_lokasi'])->name('kkn.konfigurasi_lokasi');
    Route::get('/kkn/{id}/konfigurasi_peserta', [KknController::class, 'konfigurasi_peserta'])->name('kkn.konfigurasi_peserta');
    Route::get('/kkn/{id}/konfigurasi_bataswaktu', [KknController::class, 'konfigurasi_bataswaktu'])->name('kkn.konfigurasi_bataswaktu');
    Route::get('/kkn/{id}/konfigurasi_monitoring', [KknController::class, 'konfigurasi_monitoring'])->name('kkn.konfigurasi_monitoring');
    Route::get('/kkn/{id}/konfigurasi_nilaiakhir', [KknController::class, 'konfigurasi_nilaiakhir'])->name('kkn.konfigurasi_nilaiakhir');

    Route::post('/set-batas-waktu-dosen', [KknController::class, 'setBatasWaktuDosen'])->name('set.batas.waktu.dosen');
    Route::post('/set-batas-waktu-mahasiswa', [KknController::class, 'setBatasWaktuMahasiswa'])->name('set.batas.waktu.mahasiswa');

    Route::get('/berkas', [KknController::class, 'berkas'])->name('berkas');

    Route::get('/jenis-kkn', [KknController::class, 'jenis_kkn'])->name('jenis.kkn');
    Route::post('/jenis-kkn-add', [KknController::class, 'add_jenis_kkn'])->name('jenis-kkn.add');

    Route::get('/admin/features', [AdminController::class, 'features'])->name('features');
    Route::post('/feature/store', [AdminController::class, 'feature_store'])->name('feature.store');
    Route::get('/feature/{id}/delete', [AdminController::class, 'feature_destroy'])->name('feature.delete');
    Route::put('/feature/{id}/update', [AdminController::class, 'feature_update'])->name('feature.update');

    Route::get('/admin/settings', [AdminController::class, 'index'])->name('previleges');
    Route::post('/settings/update', [AdminController::class, 'update'])->name('settings.update');
    Route::post('/settings/delete', [AdminController::class, 'destroy'])->name('settings.destroy');
    Route::post('/settings/delete-all', [AdminController::class, 'destroyAll'])->name('settings.destroyAll');
    Route::post('/settings/add', [AdminController::class, 'store'])->name('settings.store');

    Route::post('/kkn/tambah-persyaratan', [KknController::class, 'tambahPersyaratan'])->name('kkn.tambahPersyaratan');
    Route::delete('/kkn/hapus-persyaratan/{id}', [KknController::class, 'hapusPersyaratan'])->name('kkn.hapusPersyaratan');
});

Route::middleware(['checkWebServiceSession', 'checkFeature:user-management'])->group(function () {
    Route::get('/users-management', [UserController::class, 'index'])->name('users-management');
    Route::post('/users-management/store', [UserController::class, 'store'])->name('users-management.store');
    Route::get('/users-management/{nip}/delete', [UserController::class, 'destroy'])->name('users-management.delete');
    Route::put('/user/{nip}/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/{nip}/activate', [UserController::class, 'activate'])->name('user.activate');
    Route::post('/user/{nip}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');

    Route::get('/roles', [UserController::class, 'roles'])->name('roles');
    Route::post('/role/store', [UserController::class, 'role_store'])->name('role.store');
    Route::get('/role/{id}/delete', [UserController::class, 'role_destroy'])->name('role.delete');
    Route::put('/role/{id}/update', [UserController::class, 'role_update'])->name('role.update');
});

Route::get('/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');

Route::post('/get-kabupaten', [DaftarKknController::class, 'getKabupaten']);
Route::post('/get-kecamatan', [DaftarKknController::class, 'getKecamatan']);
