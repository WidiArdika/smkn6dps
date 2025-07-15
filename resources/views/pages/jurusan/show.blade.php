<x-layout>
    <div class="md:bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-yellow-100 px-6 md:px-18 lg:px-0 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-2xl md:text-4xl lg:text-5xl text-yellow-950 leading-5 md:leading-none">{{ $jurusan->nama }}</h1>
            <p class="text-base md:text-lg font-medium text-yellow-950">Jurusan SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 md:py-12 py-8 px-6 bg-white font-inter grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="col-span-3">
            <img src="{{ asset('storage/' . $jurusan->gambar) }}" class="rounded-xl mb-6 aspect-[3/2] w-full object-cover" />
            <h1 class="text-3xl lg:text-4xl font-black text-yellow-950 mb-4">{{ $jurusan->nama }}</h1>
            <div class="content-style">
                {!! $jurusan->deskripsi !!}
            </div>
        </div>
        <div class="hidden lg:block">
            <div class="mb-4">
                <h1 class="font-extrabold mb-1 md:text-2xl xl:text-3xl text-yellow-950">Jurusan Lainnya</h1>
                <div class="w-full h-1 bg-yellow-500 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 h-fit">
                @foreach ($jurusans as $jurusan)
                <x-jurusan-list-item :jurusan="$jurusan" />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>