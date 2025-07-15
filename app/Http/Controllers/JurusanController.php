<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function show(Jurusan $jurusan)
    {
        // Ambil semua jurusan kecuali yang sedang ditampilkan
        $jurusans = Jurusan::where('id', '!=', $jurusan->id)->latest()->get();

        return view('pages.jurusan.show', compact('jurusan', 'jurusans'));
    }
}
