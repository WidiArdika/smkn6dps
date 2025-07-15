@props(['pengumuman'])

<a href="{{ route('pengumuman.show', $pengumuman->slug) }}"
    class="block p-4 bg-stone-100 rounded-xl hover:bg-yellow-100 transition">

    <img src="{{ $pengumuman->gambar 
        ? asset('storage/' . $pengumuman->gambar) 
        : asset('images/fallback.jpg') }}" 
        alt="{{ $pengumuman->judul }}" 
        class="aspect-[3/2] w-full object-cover rounded-xl mb-3" />

    <h3 class="text-base font-extrabold text-yellow-950 line-clamp-1">
        {{ $pengumuman->judul }}
    </h3>

    <p class="text-sm text-stone-600 line-clamp-2">
        {{ strip_tags($pengumuman->deskripsi) }}
    </p>
</a>