<x-layout>
    <div class="w-full lg:px-45 md:py-12 py-8 px-6 bg-white font-inter grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="col-span-3 space-y-6">
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full rounded-lg aspect-3/2 object-cover">
            <h1 class="text-3xl font-bold text-yellow-500 font-inter">{{ $berita->judul }}</h1>
            <div class="flex flex-wrap items-center gap-1">
                <div class="px-4 py-1 text-xs bg-yellow-500 text-white font-bold w-fit rounded-full font-inter">
                    {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}
                </div>
                <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap font-inter">
                    Berita & Kegiatan
                </div>
            </div>
            <div class="text-stone-600 content-style font-inter">
                {!! $berita->deskripsi !!}
            </div>
            <p class="text-xs text-stone-400 mt-4 font-inter">Diterbitkan {{ $berita->created_at->diffForHumans() }}</p>
        </div>

        <div class="hidden lg:block">
            <div class="mb-4">
                <h1 class="font-extrabold mb-1 text-2xl text-yellow-950">Berita Lainnya</h1>
                <div class="w-full h-1 bg-yellow-500 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 h-fit">
                @foreach ($beritaLainnya as $item)
                    <x-berita-list-item :berita="$item" />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
