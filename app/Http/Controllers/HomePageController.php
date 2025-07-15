<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IconContent;
use App\Models\ImageCarousel;
use App\Models\Staf;
use App\Models\KepalaSekolah;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Prestasi;

class HomePageController extends Controller
{
    public function index()
    {
        // Ambil data carousel
        $images = ImageCarousel::orderBy('id', 'desc')->get();
        
        // Ambil data icon content
        $contents = IconContent::latest()->get();
        
        // ambil hanya kolom foto saja
        $fotos = Staf::pluck('foto');
        
        // ambil satu data saja
        $kepala_sekolah = KepalaSekolah::first();

        // ambil 4 berita terbaru
        $beritasTerbaru = Berita::latest()->take(4)->get();
        
        // ambil 3 berita terbaru
        $pengumumanTerbaru = Pengumuman::latest()->take(3)->get();
        
        // ambil 3 berita terbaru
        $prestasiTerbaru = Prestasi::latest()->take(3)->get();
        
        // Kirim semua data ke view home
        return view('home', compact('images', 'contents', 'fotos', 'kepala_sekolah', 'beritasTerbaru', 'pengumumanTerbaru', 'prestasiTerbaru'));
    }
}
