<x-layout>
    <div class="w-full lg:px-45 md:py-12 py-8 px-6 bg-white font-inter grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="col-span-3 space-y-6">
            <img src="{{ $prestasi->gambar 
                ? asset('storage/' . $prestasi->gambar) 
                : asset('images/fallback.jpg') }}" 
                alt="{{ $prestasi->judul }}"
                class="aspect-3/2 w-full rounded-xl object-cover">
            <h1 class="text-3xl font-bold text-yellow-500 font-inter">{{ $prestasi->judul }}</h1>
            <div class="flex flex-wrap items-center gap-1">
                <div class="px-4 py-1 text-xs bg-yellow-500 text-white font-bold w-fit rounded-full font-inter">
                    {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('l, d F Y') }}
                </div>
                <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap font-inter">
                    Prestasi
                </div>
            </div>
            <div class="text-stone-600 content-style font-inter">
                {!! $prestasi->deskripsi !!}
            </div>
            <p class="text-xs text-stone-400 mt-4 font-inter">Diterbitkan {{ $prestasi->created_at->diffForHumans() }}</p>
        </div>

        <div class="hidden lg:block">
            <div class="mb-4">
                <h1 class="font-extrabold mb-1 text-2xl text-yellow-950">Prestasi Lainnya</h1>
                <div class="w-full h-1 bg-yellow-500 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 h-fit">
                @foreach ($prestasiLainnya as $item)
                    <x-prestasi-list-item :prestasi="$item" />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
