<x-layout>
    <div class="w-full lg:px-45 md:py-12 py-8 px-6 bg-white font-inter grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="col-span-3 space-y-4">
            <img src="{{ $ekstrakurikuler->gambar 
                ? asset('storage/' . $ekstrakurikuler->gambar) 
                : asset('images/fallback.jpg') }}" 
                alt="{{ $ekstrakurikuler->judul }}"
                class="aspect-3/2 w-full rounded-xl object-cover">

            <h1 class="text-3xl font-bold text-yellow-950 font-inter">
                {{ $ekstrakurikuler->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-1">
                <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap font-inter">
                    Ekstrakurikuler
                </div>
            </div>

            <div class="text-stone-600 content-style font-inter">
                {!! $ekstrakurikuler->deskripsi !!}
            </div>
        </div>

        {{-- Sidebar Ekstrakurikuler Lainnya --}}
        <div class="hidden lg:block">
            <div class="mb-4">
                <h1 class="font-extrabold mb-1 text-2xl text-yellow-950">Ekstrakurikuler Lainnya</h1>
                <div class="w-full h-1 bg-yellow-500 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 h-fit">
                @foreach ($ekstrakurikulers as $item)
                    <x-ekstrakurikuler-list-item :ekstrakurikuler="$item" />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>