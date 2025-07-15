<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\BeritaFrontendController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\OsisController;
use App\Http\Controllers\FasilitasController;

use App\Models\ProfilSekolah;
use App\Models\Kontak;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/profil-sekolah', function () {
    $data = ProfilSekolah::first();
    return view('/pages/tentang-sekolah/profil-sekolah', compact('data'));
})->name('profil.sekolah');

Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::get('/staf-guru', [StafController::class, 'index'])->name('staf.guru');

Route::get('/jurusan/{jurusan}', [JurusanController::class, 'show'])->name('jurusan.show');

Route::get('/berita', [BeritaFrontendController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaFrontendController::class, 'show'])->name('berita.show');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{slug}', [PrestasiController::class, 'show'])->name('prestasi.show');

Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
Route::get('/ekstrakurikuler/{slug}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');

Route::get('/osis', [OsisController::class, 'index'])->name('osis');

Route::get('/kontak', function () {
    $kontak = Kontak::firstOrNew([]);
    return view('pages.kontak.kontak', compact('kontak'));
})->name('kontak.index');

Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');