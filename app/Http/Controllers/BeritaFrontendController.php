<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaFrontendController extends Controller
{
    public function index(Request $request)
    {
        // Ambil berita pertama dan kedua yang published untuk highlight
        $beritaPertama = Berita::published()->latest()->first();
        $beritaKedua = Berita::published()->latest()->skip(1)->take(1)->first();

        // Query untuk berita dengan filter published
        $query = Berita::published()->latest();

        // Filter search jika ada
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Paginate berita yang published
        $berita = $query->paginate(6)->withQueryString();

        return view('pages.informasi.berita', compact('berita', 'beritaPertama', 'beritaKedua'));
    }

    public function show($slug)
    {
        // Hanya berita yang published bisa diakses
        $berita = Berita::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Ambil 5 berita lain secara acak yang published, kecuali yang sedang ditampilkan
        $beritaLainnya = Berita::published()
            ->where('id', '!=', $berita->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('pages.informasi.berita-show', compact('berita', 'beritaLainnya'));
    }
}