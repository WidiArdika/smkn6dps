@props(['berita'])

<a href="{{ route('berita.show', $berita->slug) }}"
    class="block p-4 bg-stone-100 rounded-xl hover:bg-yellow-100 transition">

    <img src="{{ $berita->gambar 
        ? asset('storage/' . $berita->gambar) 
        : asset('images/fallback.jpg') }}" 
        alt="{{ $berita->judul }}" 
        class="aspect-[3/2] w-full object-cover rounded-xl mb-3" />

    <h3 class="text-base font-extrabold text-yellow-950 line-clamp-1">
        {{ $berita->judul }}
    </h3>

    <p class="text-sm text-stone-600 line-clamp-2">
        {{ strip_tags($berita->deskripsi) }}
    </p>
</a>