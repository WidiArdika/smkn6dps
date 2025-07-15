@props(['foto', 'nama', 'nip' => null, 'jabatan' => null])

<div class="max-w-xs bg-yellow-700 rounded-xl shadow-lg overflow-hidden">
    <div class="bg-stone-300 p-3 md:p-6 xl:p-9">
        <img 
            src="{{ asset('storage/' . $foto) }}" 
            alt="{{ $nama }}" 
            class="aspect-[3/4] w-full object-cover rounded-md border-9 border-white"
        >
    </div>
    <div class="text-center px-4 py-4 bg-gradient-to-b from-yellow-600 to-yellow-700 text-white">
        <h2 class="font-bold text-lg leading-tight">{{ $nama }}</h2>

        @if ($nip)
            <p class="text-sm mt-1">NIP : {{ $nip }}</p>
        @endif

        @if ($jabatan)
            <p class="text-sm italic mt-1">{{ $jabatan }}</p>
        @endif
    </div>
</div>
