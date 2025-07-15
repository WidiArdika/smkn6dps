<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $prestasi = $query->paginate(9)->withQueryString();

        return view('pages.kesiswaan.prestasi', compact('prestasi'));
    }

    public function show($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        // Ambil 5 prestasi terbaru, kecuali yang sedang ditampilkan
        $prestasiLainnya = Prestasi::where('id', '!=', $prestasi->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pages.kesiswaan.prestasi-show', compact('prestasi', 'prestasiLainnya'));
    }
}
