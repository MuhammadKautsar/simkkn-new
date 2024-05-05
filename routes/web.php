<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KknController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/berkas', function () {
    return view('panitia.berkas');
})->name('berkas');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/tes', [LoginController::class, 'testConnection'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'login'])
    ->middleware('guest');

// Route::post('/sign-in', [LoginController::class, 'prosesLogin'])
//     ->middleware('guest');

Route::get('/logout', [LoginController::class, 'destroy'])
    ->name('logout');

Route::middleware(['checkWebServiceSession'])->group(function () {
    Route::get('/beranda', [MahasiswaController::class, 'index'])->name('beranda');
    Route::get('/daftar', [MahasiswaController::class, 'create'])->name('daftar');
});

Route::prefix('dosen')->middleware(['checkWebServiceSession'])->group(function () {
// Route::prefix('dosen')->group(function () {
    Route::get('beranda', [DosenController::class, 'index'])->name('dosen.beranda');
    Route::get('detail', [DosenController::class, 'create'])->name('detail');
});

Route::get('panitia/sign-in', [LoginController::class, 'panitia_index'])
    ->middleware('guest')
    ->name('panitia-sign-in');

Route::post('panitia/sign-in', [LoginController::class, 'panitia_login'])
    ->middleware('guest');

// Route::group(['middleware' => 'auth'], function () {
Route::group([], function () {
    // Route::get('/dashboard', [KknController::class, 'index'])->name('dashboard')->middleware('auth:web,puksi');
    Route::get('/dashboard', [KknController::class, 'index'])->name('dashboard');
    Route::get('/kkn/create', [KknController::class, 'create'])->name('kkn.create');
    Route::post('/kkn', [KknController::class, 'store'])->name('kkn.store');
    Route::get('/kkn/{id}/edit', [KknController::class, 'edit'])->name('kkn.edit');

    Route::put('/kkn/{id}/update', [KknController::class, 'update'])->name('kkn.update');

    Route::get('/jenis-kkn', [KknController::class, 'jenis_kkn'])->name('jenis.kkn');
    Route::post('/jenis-kkn-add', [KknController::class, 'add_jenis_kkn'])->name('jenis-kkn.add');

    Route::get('/users-management', [UserController::class, 'index'])->name('users-management');
    Route::post('/users-management/store', [UserController::class, 'store'])->name('users-management.store');
});

Route::get('/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
