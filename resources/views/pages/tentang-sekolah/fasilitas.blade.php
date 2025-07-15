<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Fasilitas Sekolah</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 lg:py-12 py-8 font-inter">
        <head>
            {{-- Three.js dan Panolens dari CDN --}}
            <script src="https://cdn.jsdelivr.net/npm/three@0.105.2/build/three.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/panolens@0.12.0/build/panolens.min.js"></script>
        </head>

        <div>

            <div class="relative">
                {{-- Tombol panah kiri --}}
                <button id="scrollLeft" class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 z-10 hover:bg-yellow-300 text-yellow-950 p-2 ml-2 rounded-full">
                    ❮
                </button>

                {{-- Container scrollable --}}
                <div id="fasilitasTabs" class="flex overflow-x-auto bg-yellow-100 rounded-t-xl gap-4 py-4 px-4 lg:px-12 scrollbar-hide scroll-smooth">
                    @foreach($fasilitas as $item)
                        <button 
                            class="tab-btn px-6 py-2 bg-yellow-300 hover:bg-yellow-500 focus:bg-yellow-600 text-yellow-950 text-sm font-bold rounded-lg whitespace-nowrap"
                            data-target="{{ $item->id }}"
                        >
                            {{ $item->nama }}
                        </button>
                    @endforeach
                </div>

                {{-- Tombol panah kanan --}}
                <button id="scrollRight" class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 z-10 hover:bg-yellow-300 text-yellow-950 p-2 mr-2 rounded-full">
                    ❯
                </button>
            </div>

            {{-- Viewer container tunggal --}}
            <div id="panolens-container" class="relative w-full h-[500px] z-10">
                <img src="{{ asset('images/logo-nadir-256.png') }}" class="absolute top-3 left-3 size-15" alt="logo-smkn6dps">
            </div>

            <div class="bg-stone-100 rounded-b-xl pb-8 px-12 text-sm text-stone-800 font-normal text-justify">
                Pentingnya fasilitas yang lengkap tidak hanya terletak pada fisik bangunan, tetapi juga pada nilai-nilai yang dibangun dari pengalaman siswa menggunakannya. Fasilitas yang mendukung akan melahirkan generasi yang tidak hanya pintar secara akademis, tetapi juga tangguh, kreatif, dan siap menghadapi tantangan dunia kerja. Dengan fasilitas yang ada, kami percaya bahwa SMK Negeri 6 Denpasar mampu menjadi tempat tumbuhnya potensi terbaik generasi muda Bali.
            </div>

        </div>
    </div>
    @include('partials.fasilitas-script')
</x-layout>