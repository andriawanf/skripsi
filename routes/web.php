<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DataGuruController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\General\HomeController;
use App\Http\Controllers\KepalaSekolah\KepalaSekolahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk login dan register
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// guru route
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/form-pengajuan-cuti', function () {
        return view('general.cuti-tahunan');
    })->name('cuti-tahunan');
    Route::get('/form-cuti-lainnya', function () {
        return view('general.cuti-lainnya');
    })->name('cuti-lainnya');
    Route::get('/riwayat-pengajuan-cuti', function () {
        return view('general.riwayat-pengajuan-cuti');
    })->name('riwayat-cuti');
    Route::get('/pengaturan', function () {
        return view('general.pengaturan');
    })->name('pengaturan');
});


// Admin dan kepala sekolah Route
Route::group(['middleware' => ['auth', 'admin']], function () {
    // Rute untuk halaman beranda berdasarkan peran pengguna
    Route::get('/admin/dashboard-admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/kepalaSekolah/dashboard', [KepalaSekolahController::class, 'index'])->name('kepala_sekolah');

    Route::get('/data-guru', [AdminController::class, 'dataGuru'])->name('data-guru');
    Route::post('/data-guru', [DataGuruController::class, 'storeDataGuru'])->name('store-data-guru');
    Route::get('/riwayat-cuti-guru', [AdminController::class, 'riwayatCutiGuru'])->name('riwayat-cuti-guru');
    Route::get('/Tambah-subkategori', [AdminController::class, 'showTambahSubkategori'])->name('tambah-subkategori');
    Route::post('/tambah-subkategori', [AdminController::class, 'storeSubkategori'])->name('store-data-subkategori');
    Route::get('/tambah-kategori', [AdminController::class, 'showTambahKategori'])->name('tambah-kategori');
    Route::post('/tambah-kategori', [AdminController::class, 'storeKategori'])->name('store-data-kategori');
});
Route::get('/download-laporan', [AdminController::class, 'exportPDF'])->name('download-laporan');
Route::get('/download-data-guru', [AdminController::class, 'exportEXCELDataGuru'])->name('download-data-guru');
Route::get('/download-riwayat-cuti-guru', [AdminController::class, 'exportPDFRiwayatCutiGuru'])->name('download-riwayat-cuti-guru');
Route::get('/export-cuti-guru/{id}', [AdminController::class, 'exportDocx'])->name('download-cuti-guru');
Route::get('/cetakLaporan', [AdminController::class, 'cetakLaporan'])->name('cetakLaporan');


// Route Kepsek
// Route::get('/data-guru', [KepalaSekolahController::class, 'dataGuru'])->name('data-guru')->middleware(['auth', 'kepala_sekolah',]);
// Route::get('/riwayat-cuti-guru', [AdminController::class, 'riwayatCutiGuru'])->name('riwayat-cuti-guru');