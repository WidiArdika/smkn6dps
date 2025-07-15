<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Osis;

class OsisController extends Controller
{
    public function index()
    {
        // Ambil entri OSIS terbaru (misalnya: periode aktif)
        $osis = Osis::latest()->first();

        return view('pages.kesiswaan.osis', compact('osis'));
    }
}
