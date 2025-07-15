<div>
    <a href="{{ route('prestasi.show', $prestasi->slug) }}" class="text-stone-900 font-bold line-clamp-2 hover:underline">{{ $prestasi->judul }}</a>
    <p class="mb-1.5 text-stone-600 text-sm font-light line-clamp-2">{{ strip_tags($prestasi->deskripsi) }}</p>
    <div class="mb-5 flex flex-wrap items-center gap-1">
        <div class="px-4 py-1 text-xs bg-blue-500 text-white font-bold w-fit rounded-full whitespace-nowrap">
            {{ $prestasi->created_at->diffForHumans() }}
        </div>
        <div class="px-4 py-1 text-xs bg-yellow-500 text-white font-bold w-fit rounded-full whitespace-nowrap">
            {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('l, d F Y') }}
        </div>
        <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap">
            Prestasi
        </div>
    </div>
    <hr class="text-yellow-500">
</div>