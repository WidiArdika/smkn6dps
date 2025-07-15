@props(['prestasi'])

<a href="{{ route('prestasi.show', $prestasi->slug) }}"
    class="block p-4 bg-stone-100 rounded-xl hover:bg-yellow-100 transition">

    <img src="{{ $prestasi->gambar 
        ? asset('storage/' . $prestasi->gambar) 
        : asset('images/fallback.jpg') }}" 
        alt="{{ $prestasi->judul }}" 
        class="aspect-[3/2] w-full object-cover rounded-xl mb-3" />

    <h3 class="text-base font-extrabold text-yellow-950 line-clamp-1">
        {{ $prestasi->judul }}
    </h3>

    <p class="text-sm text-stone-600 line-clamp-2">
        {{ strip_tags($prestasi->deskripsi) }}
    </p>
</a>