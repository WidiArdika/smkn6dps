<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaFrontendController extends Controller
{
    public function index(Request $request)
    {
        $beritaPertama = Berita::latest()->first();
        $beritaKedua = Berita::latest()->skip(1)->take(1)->first();

        $query = Berita::latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $berita = $query->paginate(6)->withQueryString();

        return view('pages.informasi.berita', compact('berita', 'beritaPertama', 'beritaKedua'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // Ambil 5 berita lain secara acak, kecuali yang sedang ditampilkan
        $beritaLainnya = Berita::where('id', '!=', $berita->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('pages.informasi.berita-show', compact('berita', 'beritaLainnya'));
    }
}
