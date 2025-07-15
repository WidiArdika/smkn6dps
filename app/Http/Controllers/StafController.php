<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staf;
use App\Models\KepalaSekolah;

class StafController extends Controller
{
    public function index()
    {
        $stafs = Staf::all(); // Ambil semua data staf
        $kepala_sekolah = KepalaSekolah::first(); // ambil satu saja

        return view('pages.tentang-sekolah.staf-guru', compact('stafs', 'kepala_sekolah'));
    }
}
