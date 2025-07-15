@props(['pengumuman', 'lineClamp' => 5, 'textSize' => 'lg'])

@if ($pengumuman)
    <div {{ $attributes->class(['overflow-hidden rounded-xl bg-white shadow-md']) }}>
        <div class="relative">
            <a href="{{ route('pengumuman.show', $pengumuman->slug) }}">
                <img src="{{ $pengumuman->gambar 
                    ? asset('storage/' . $pengumuman->gambar) 
                    : asset('images/fallback.jpg') }}" 
                    alt="{{ $pengumuman->judul }}"
                    class="aspect-3/2 w-full object-cover">
            </a>
            <div class="absolute top-1.5 right-1.5 px-3 py-1 rounded-full bg-stone-900/50">
                <p class="text-white text-xs font-inter">
                    {{ $pengumuman->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <div class="px-6 pt-4 pb-2">
            <a href="{{ route('pengumuman.show', $pengumuman->slug) }}"
                class="line-clamp-2 text-{{ $textSize }} font-bold text-yellow-500 hover:underline font-inter">
                {{ $pengumuman->judul }}
            </a>
        </div>
        <div class="px-6 flex flex-wrap items-center gap-1">
            <div class="px-4 py-1 text-xs bg-yellow-500 text-white font-bold w-fit rounded-full font-inter">
                {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d/m/y') }}
            </div>
            <div class="px-4 py-1 text-xs bg-stone-900 text-white font-bold w-fit rounded-full whitespace-nowrap font-inter">
                Pengumuman
            </div>
        </div>
        <div class="px-6 pb-4 pt-2">
            <p class="line-clamp-{{ $lineClamp }} text-sm/relaxed text-stone-600 font-inter">
                {{ strip_tags($pengumuman->deskripsi) }}
            </p>
        </div>
    </div>
@else
    <div class="p-4 bg-red-100 text-red-600 font-semibold">
        Belum ada data Pengumuman. Admin belum menambahkan data pada Pengumuman.
    </div>
@endif