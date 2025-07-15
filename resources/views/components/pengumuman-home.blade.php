<div>
    <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="text-stone-900 font-bold line-clamp-2 hover:underline">{{ $pengumuman->judul }}</a>
    <p class="mb-1.5 text-stone-600 text-sm font-light line-clamp-2">{{ strip_tags($pengumuman->deskripsi) }}</p>
    <div class="mb-5 flex flex-wrap items-center gap-1">
        <div class="px-4 py-1 text-xs bg-blue-500 text-white font-bold w-fit rounded-full whitespace-nowrap">
            {{ $pengumuman->created_at->diffForHumans() }}
        </div>
        <div class="px-4 py-1 text-xs bg-yellow-500 text-white font-bold w-fit rounded-full whitespace-nowrap">
            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('l, d F Y') }}
        </div>
        <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap">
            Pengumuman
        </div>
    </div>
    <hr class="text-yellow-500">
</div>