<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Setting - Profil Pengguna
Route::get('/setting/profile', function () {
    return view('setting.profile');
})->name('setting.profile');

// Organisasi
Route::prefix('organisasi')->name('organisasi.')->group(function () {
    Route::get('/', fn() => view('organisasi.index'))->name('index');
    Route::get('/profil', fn() => view('organisasi.profil'))->name('profil');
    Route::get('/departemen', fn() => view('organisasi.departemen'))->name('departemen');
    Route::get('/jabatan', fn() => view('organisasi.jabatan'))->name('jabatan');
});

// Karyawan
Route::prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/karyawan-dibeberapa-kantor', fn() => view('karyawan.karyawan-dibeberapa-kantor'))->name('karyawan-dibeberapa-kantor');
    Route::get('/karyawan-dibeberapa-kantor-sebagai-admin', fn() => view('karyawan.karyawan-dibeberapa-kantor-sebagai-admin'))->name('karyawan-dibeberapa-kantor-sebagai-admin');
});


// Absensi
Route::get('/absensi', fn() => view('absensi.index'))->name('absensi.index');

// Laporan
Route::get('/laporan', fn() => view('laporan.index'))->name('laporan.index');