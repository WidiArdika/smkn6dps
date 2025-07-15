<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Jurusan;

class JurusanCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $gambar,
        public string $judul,
        public string $deskripsi,
        public Jurusan $jurusan
    )
    {
        //
    }

    public function getRouteKeyName(): string
    {
        return 'slug'; // agar {jurusan} resolve-nya pakai slug, bukan id
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jurusan-card');
    }
}
