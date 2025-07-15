<a href="{{ route('jurusan.show', $jurusan) }}" class="items-start gap-4 p-4 hover:bg-yellow-100 bg-stone-100 rounded-xl transition">
    <img src="{{ $jurusan->image_url }}" alt="{{ $jurusan->nama }}" class="aspect-[3/2] w-full object-cover rounded-xl shrink-0" />
    <div class="mt-3">
        <h3 class="text-base font-extrabold text-yellow-950 line-clamp-1">{{ $jurusan->nama }}</h3>
        <p class="text-sm text-stone-600 line-clamp-2">{{ strip_tags($jurusan->deskripsi) }}</p>
    </div>
</a>
