@props(['ekstrakurikuler', 'lineClamp' => 5, 'textSize' => 'lg'])

@if ($ekstrakurikuler)
    <div {{ $attributes->class(['overflow-hidden rounded-xl bg-white shadow-md']) }}>
        <div class="">
            <a href="{{ route('ekstrakurikuler.show', $ekstrakurikuler->slug) }}">
                <img src="{{ $ekstrakurikuler->gambar 
                    ? asset('storage/' . $ekstrakurikuler->gambar) 
                    : asset('images/fallback.jpg') }}" 
                    alt="{{ $ekstrakurikuler->judul }}"
                    class="aspect-3/2 w-full object-cover">
            </a>
        </div>
        <div class="px-6 pt-4 pb-2">
            <a href="{{ route('ekstrakurikuler.show', $ekstrakurikuler->slug) }}"
                class="line-clamp-2 text-{{ $textSize }} font-bold text-yellow-500 hover:underline font-inter">
                {{ $ekstrakurikuler->judul }}
            </a>
        </div>
        <div class="px-6 flex flex-wrap items-center gap-1">
            <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap font-inter">
                Ekstrakurikuler
            </div>
        </div>
        <div class="px-6 pb-4 pt-2">
            <p class="line-clamp-{{ $lineClamp }} text-sm/relaxed text-stone-600 font-inter">
                {{ strip_tags($ekstrakurikuler->deskripsi) }}
            </p>
        </div>
    </div>
@else
    <div class="p-4 bg-red-100 text-red-600 font-semibold">
        Belum ada data Ekstrakurikuler. Admin belum menambahkan data pada Ekstrakurikuler.
    </div>
@endif