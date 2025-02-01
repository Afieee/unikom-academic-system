<?php

use App\Http\Controllers\AkademisiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'landingPageSiakad']);

Route::get('/Login', [LoginController::class, 'halamanLogin']);

Route::post('login', [LoginController::class, 'prosesLogin']);
// Proses Untuk Logout
Route::get('/proses-logout', [LoginController::class, 'prosesLogout']);
// Halaman yang mengarahkan pengguna setelah logout
Route::get('/logout-berhasil', [LoginController::class, 'halamanSetelahLogout']);


Route::get('/akademisi/tolol', [AkademisiController::class, 'tolol'])->name('akademisi.tolol');
Route::post('/register-berhasil', [AkademisiController::class, 'tambahPenggunaAkademisi']);
Route::post('/ganjil-genap', [AkademisiController::class, 'ubahGenapGanjil'])->name('ubahGenapGanjil');
Route::post('/naik-tahun', [AkademisiController::class, 'naikTahun']);



Route::get('/dashboard', [LoginController::class, 'dashboard'])->middleware('auth')->name('halaman-dashboard');
Route::post('/sinkronisasi-semester', [AkademisiController::class, 'sinkronisasiSemester'])->middleware('auth');

Route::post('/register-berhasil', [RegisterController::class, 'tambahPenggunaAkademisi']);



Route::post('/profile/update-foto/{id_users}', [ProfileController::class, 'updateFotoProfile']);


Route::get('/manajemen-view-mahasiswa', [AkademisiController::class, 'halamanViewMahasiswa']);
Route::get('/manajemen-view-dosen', [AkademisiController::class, 'halamanViewDosen']);
Route::get('/manajemen-view-sekretariat', [AkademisiController::class, 'halamanViewSekretariat']);
Route::get('/manajemen-view-matakuliah', [AkademisiController::class, 'halamanViewMatakuliah'])->name('sekre.view.matkul');
Route::get('/manajemen-view-tambah-matakuliah', [MatakuliahController::class, 'halamanTambahMatakuliah']);
Route::post('/proses-tambah-matakuliah', [MatakuliahController::class, 'simpanMatakuliah']);

Route::get('/manajemen-akademisi', [AkademisiController::class, 'halamanViewAkademisi']);



Route::get('/mahasiswa-view-kurikulum', [MatakuliahController::class, 'mahasiswaTampilMatakuliah']);
Route::get('/mahasiswa-view-jadwal', [MatakuliahController::class, 'tampilJadwalMahasiswa']);
Route::get('/mahasiswa-view-nilai', [AkademisiController::class, 'historyNilaiMahasiswa']);
Route::get('/export-nilai/{nim}/{nama}', [AkademisiController::class, 'exportNilai']);




Route::get('/dosen-view-penilaian', [AkademisiController::class, 'viewPenilaian']);
Route::get('/dosen-update-penilaian/{id_perwalian}', [AkademisiController::class, 'halamanUpdateNilai'])->name('halamanUpdateNilai');

Route::put('/dosen-update-penilaian/{id_perwalian}', [AkademisiController::class, 'updateNilai'])->name('updateNilai');
