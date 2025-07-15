<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::latest()->get();
        return view('pages.kesiswaan.ekstrakurikuler', compact('ekstrakurikulers'));
    }

    public function show($slug)
    {
        $ekstrakurikuler = Ekstrakurikuler::where('slug', $slug)->firstOrFail();

        // Ambil 5 data acak, kecuali yang sedang ditampilkan
        $ekstrakurikulers = Ekstrakurikuler::where('id', '!=', $ekstrakurikuler->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('pages.kesiswaan.ekstrakurikuler_show', compact('ekstrakurikuler', 'ekstrakurikulers'));
    }
}