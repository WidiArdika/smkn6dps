<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Staf dan Guru</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 lg:py-12 py-8 px-4 md:px-8 font-inter">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @if ($kepala_sekolah)
                <x-staf-card 
                    :foto="$kepala_sekolah->foto"
                    :nama="$kepala_sekolah->nama" 
                    :nip="$kepala_sekolah->nip"
                    jabatan="Kepala Sekolah" {{-- hardcoded jabatan --}}
                />
            @endif
            @foreach ($stafs as $staf)
                <x-staf-card 
                    :foto="$staf->foto"
                    :nama="$staf->nama" 
                    :nip="$staf->nip" 
                    :jabatan="$staf->jabatan" 
                />
            @endforeach
        </div>
    </div>
</x-layout>