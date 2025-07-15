<x-layout>
    <div class="mx-auto bg-repeat lg:pb-6 bg-[length:800px]" style="background-image: url('{{ asset('images/YellowBG.svg') }}');">
        @if($images->count() > 0)
            <div class="lg:px-45 lg:py-6">
                <div class="w-full mx-auto relative" 
                    x-data="{
                        activeSlide: 1,
                        images: {{ $images->toJson() }},
                        totalSlides: {{ $images->count() }}
                    }"
                    x-init="
                        setInterval(() => {
                            activeSlide = activeSlide === totalSlides ? 1 : activeSlide + 1
                        }, 10000)
                    ">

                    {{-- Image Display --}}
                    <div class="w-full flex items-center bg-gray-200 lg:rounded-xl overflow-hidden shadow-lg">
                        <div class="w-full aspect-[2.76/1] relative overflow-hidden">
                            <div class="flex transition-transform duration-700 ease-in-out h-full"
                                :style="`transform: translateX(-${(activeSlide - 1) * 100}%)`">
                                <template x-for="(image, index) in images" :key="image.id">
                                    <div class="w-full h-full flex-shrink-0 relative">
                                        <img :src="'{{ asset('storage') }}/' + image.image_path" 
                                            :alt="image.title"
                                            class="absolute top-0 left-0 w-full h-full object-cover">
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation Buttons --}}
                    <div class="absolute inset-0 lg:flex hidden group">
                        {{-- Previous Button --}}
                        <div class="flex items-center justify-start w-1/2">
                            <button
                                x-on:click="activeSlide = activeSlide === 1 ? totalSlides : activeSlide - 1"
                                class="opacity-0 group-hover:opacity-100 hover:bg-gradient-to-r from-black/50 to-black/0 text-white hover:text-yellow-300 transition-all duration-300 font-bold rounded-l-xl w-15 h-full flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        
                        {{-- Next Button --}}
                        <div class="flex items-center justify-end w-1/2">
                            <button
                                x-on:click="activeSlide = activeSlide === totalSlides ? 1 : activeSlide + 1"
                                class="opacity-0 group-hover:opacity-100 hover:bg-gradient-to-l from-black/50 to-black/0 text-white hover:text-yellow-300 transition-all duration-300 font-bold rounded-r-xl w-15 h-full flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="lg:px-45 lg:py-6">
                <div class="w-full mx-auto relative">
                    <div class="w-full flex items-center bg-gray-200 lg:rounded-xl overflow-hidden shadow-lg">
                        <div class="w-full aspect-[2.76/1] relative overflow-hidden">
                            <div class="flex h-full">
                                <div class="w-full h-full flex-shrink-0 relative">
                                    <div class="bg-stone-500 lg:rounded-xl absolute top-0 left-0 w-full h-full object-cover flex items-center justify-center">
                                        <p class="text-white text-lg">Belum ada gambar yang ditampilkan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="lg:px-45 grid grid-cols-1 md:grid-cols-3 p-4 lg:p-0 gap-2 md:gap-4 lg:gap-6">
            @foreach($contents as $content)
                <x-icon-content-card :content="$content" />
            @endforeach
        </div>
    </div>

    <div class="border-t-9 border-white lg:px-45 lg:py-12 p-4 lg:p-0 bg-repeat mx-auto bg-[length:800px]" style="background-image: url('{{ asset('images/WhiteBG.svg') }}');">
        @php
            $profile = \App\Models\ProfileInfo::first(); // Ambil 1 data saja
        @endphp
        @if ($profile)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 font-inter items-center">
                <div>
                    @if ($profile->isYoutubeValid())
                        <iframe class="w-full aspect-video rounded-xl shadow-xl"
                            src="{{ $profile->youtube_url }}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen>
                        </iframe>
                    @else
                        <img src="{{ asset('images/fallback.jpg') }}" alt="Video tidak tersedia"
                            class="w-full aspect-video object-cover rounded-xl shadow-xl" />
                    @endif
                </div>
                <div class="bg-white rounded-xl shadow-[0_0_20px_rgba(0,0,0,0.1)] p-8 lg:p-10">
                    <h1 class="font-black text-xl md:text-2xl xl:text-3xl text-yellow-950 pb-3 uppercase leading-none text-center">
                        {{ $profile->judul }}
                    </h1>
                    <p class="text-justify text-stone-900 text-xs xl:text-sm pb-3">
                        {{ $profile->deskripsi }}
                    </p>
                    <a class="text-xs xl:text-sm py-3 bg-yellow-300 rounded-xl flex items-center justify-center text-yellow-900 font-bold hover:bg-yellow-400 hover:text-yellow-950" href="{{ route('profil.sekolah') }}">
                        Baca Selengkapnya ->
                    </a>
                </div>
            </div>
        @else
            <div class="py-6 text-center text-red-600">
                Data profil belum tersedia. Admin belum menambahkan detail profil.
            </div>
        @endif
    </div>

    <div class="lg:px-45 pb-6 md:pb-12 font-inter bg-yellow-50">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-4 md:py-6 lg:py-8 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <p class="text-sm md:text-lg lg:text-xl font-medium text-yellow-950 leading-none mb-1">Mulai masa depan mu di sini</p>
            <h1 class="font-black text-xl md:text-3xl lg:text-4xl uppercase text-yellow-950 leading-none">Jurusan <span class="text-white">SIXSKA Denpasar</span></h1>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5 mb-4 lg:mb-6"></div>

        @php
            $jurusans = \App\Models\Jurusan::all();
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-4 lg:px-0 md:px-8 gap-4 md:gap-6 items-center">
            @foreach ($jurusans as $jurusan)
                <x-jurusan-card 
                    :gambar="asset('storage/' . $jurusan->gambar)"
                    :judul="$jurusan->nama"
                    :deskripsi="$jurusan->deskripsi"
                    :jurusan="$jurusan"
                />
            @endforeach
        </div>
    </div>

    <div class="lg:px-50 xl:px-80 lg:py-22 md:px-20 px-4 py-18 lg:p-0 bg-repeat mx-auto bg-[length:800px]" style="background-image: url('{{ asset('images/BlackBG.svg') }}');">
        <div class="text-center font-inter">
            <h1 class="text-white font-black text-4xl md:text-5xl">Fasilitas Sekolah</h1>
            <p class="mt-2 mb-6 text-white font-light text-xs md:text-base">Jelajahi fasilitas lengkap kami mulai dari ruang belajar modern hingga area praktik kejuruan yang semuanya dirancang untuk membekali siswa dengan pengalaman belajar yang nyata dan relevan.</p>
            <a href="{{ route('fasilitas.index') }}" class="py-3 px-12 bg-yellow-300 font-bold text-yellow-950 hover:bg-yellow-500 rounded-xl">Jelajahi Fasilitas</a>
        </div>
    </div>

    <div class="lg:px-45 lg:py-12 p-4 md:py-8 md:px-8 lg:p-0">
        <div class="font-inter flex items-end justify-between mb-3 lg:mb-4">
            <p class="text-stone-900 font-extrabold text-lg md:hidden">Daftar Staf dan Guru</p>
            <p class="text-stone-900 font-extrabold text-lg lg:text-2xl hidden md:block">Daftar Staf dan Guru SMK Negeri 6 Denpasar</p>
            <a href="{{ route('staf.guru') }}">
                <div class="text-xs lg:text-base px-4 md:px-8 py-2 bg-yellow-300 rounded-xl text-yellow-900 font-bold hover:bg-yellow-400 hover:text-yellow-950 w-fit">
                    <p class="md:hidden">Selengkapnya -></p>
                    <p class="hidden md:block">Lihat Selengkapnya -></p>
                </div>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 h-100 md:h-54 lg:h-63 bg-stone-900 rounded-xl">
            @if ($kepala_sekolah)
            <div class="grid grid-cols-2 overflow-hidden bg-stone-900 rounded-xl">
                <div class="overflow-hidden flex justify-center p-4">
                    @if ($kepala_sekolah && $kepala_sekolah->foto)
                        <img 
                        class="aspect-3/4 rounded-xl h-full object-cover" 
                        src="{{ asset('storage/' . $kepala_sekolah->foto) }}" 
                        alt="{{ $kepala_sekolah->nama }}">
                    @endif
                </div>
                <div class="font-inter py-6 pr-3 lg:pr-0 xl:pr-4 flex flex-col justify-end overflow-hidden">
                    <div class="text-stone-900 text-xs font-bold bg-yellow-300 rounded-full w-fit px-3.5 py-1">
                        Kepala Sekolah
                    </div>
                    <h1 class="text-white font-bold text-lg lg:text-xl leading-5 lg:leading-6 mt-1.5">
                        {{ $kepala_sekolah->nama }}
                    </h1>
                    <div class="bg-stone-400 h-px my-2"></div>
                    <p class="text-stone-400 text-xs xl:text-sm leading-none line-clamp-1">
                        NIP. {{ $kepala_sekolah->nip }}
                    </p>
                </div>
            </div>
            @endif

            <div 
                class="w-full lg:col-span-2"
                :class="{
                    'overflow-hidden mask-fade': animated
                }"
                x-data="{
                    animated: false,
                    direction: 'right',
                    speed: 'slow'
                }"
                x-init="
                    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                        animated = true;
                        const scrollerInner = $el.querySelector('.scroller-inner');
                        const scrollerContent = Array.from(scrollerInner.children);
                        scrollerContent.forEach((item) => {
                            const duplicatedItem = item.cloneNode(true);
                            duplicatedItem.setAttribute('aria-hidden', true);
                            scrollerInner.appendChild(duplicatedItem);
                        });
                    }
                "
            >
                <div 
                    class="flex flex-wrap py-4 h-full gap-4 scroller-inner bg-yellow-100"
                    :class="{
                        'w-max flex-nowrap': animated,
                        'animate-scroll-reverse-slow': animated && direction === 'right' && speed === 'slow',
                        'animate-scroll-reverse-fast': animated && direction === 'right' && speed === 'fast',
                        'animate-scroll-slow': animated && direction === 'left' && speed === 'slow',
                        'animate-scroll-fast': animated && direction === 'left' && speed === 'fast'
                    }"
                >
                    @foreach ($fotos as $foto)
                        <img 
                            class="aspect-3/4 rounded-xl h-full object-cover" 
                            src="{{ asset('storage/' . $foto) }}" 
                            alt="Foto staf"
                        >
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="bg-yellow-50 lg:px-45 lg:py-12 p-4 md:py-8 md:px-8 lg:p-0 font-inter">
        <div class="font-inter flex items-end justify-between mb-3 lg:mb-4">
            <p class="text-stone-900 font-extrabold text-lg md:hidden">Berita & Kegiatan</p>
            <p class="text-stone-900 font-extrabold text-lg lg:text-2xl hidden md:block">Daftar Berita dan Kegiatan terkini</p>
            <a href="{{ route('berita.index') }}" class="hidden md:block">
                <div class="text-xs lg:text-base px-4 md:px-8 py-2 bg-stone-900 rounded-xl text-white font-bold hover:bg-stone-700 w-fit">
                    <p class="md:hidden">Selengkapnya -></p>
                    <p class="hidden md:block">Lihat Selengkapnya -></p>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-center mb-4">
            @foreach ($beritasTerbaru as $berita)
                <x-berita-card :berita="$berita" />
            @endforeach
        </div>
        <div class="md:hidden">
            <a href="{{ route('berita.index') }}" class="text-xs lg:text-base px-4 md:px-8 py-2 bg-yellow-300 rounded-xl text-yellow-900 font-bold hover:bg-yellow-400 hover:text-yellow-950 w-fit inline-block">
                Lihat Berita Lainnya ->
            </a>
        </div>
    </div>

    <div class="lg:px-45 lg:py-12 p-4 md:py-8 md:px-8 lg:p-0 font-inter">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-9 md:gap-18 items-center font-inter">
            <div>
                <div class="w-fit mb-5">
                    <h1 class="font-bold text-stone-900 text-2xl">Daftar Pengumuman Terkini</h1>
                    <div class="bg-yellow-500 w-full h-1"></div>
                </div>
                <div class="mb-5 grid grid-flow-col grid-rows-3 gap-4">
                    @foreach ($pengumumanTerbaru as $pengumuman)
                        <x-pengumuman-home :pengumuman="$pengumuman" />
                    @endforeach
                </div>
                <a href="{{ route('pengumuman.index') }}" class="text-xs lg:text-base px-4 md:px-8 py-2 bg-yellow-300 rounded-xl text-yellow-900 font-bold hover:bg-yellow-400 hover:text-yellow-950 w-fit inline-block">
                    Pengumuman Lainnya ->
                </a>
            </div>
            <div>
                <div class="w-fit mb-5">
                    <h1 class="font-bold text-stone-900 text-2xl">Daftar Prestasi Terkini</h1>
                    <div class="bg-yellow-500 w-full h-1"></div>
                </div>
                <div class="mb-5 grid grid-flow-col grid-rows-3 gap-4">
                    @foreach ($prestasiTerbaru as $prestasi)
                        <x-prestasi-home :prestasi="$prestasi" />
                    @endforeach
                </div>
                <a href="{{ route('prestasi.index') }}" class="text-xs lg:text-base px-4 md:px-8 py-2 bg-yellow-300 rounded-xl text-yellow-900 font-bold hover:bg-yellow-400 hover:text-yellow-950 w-fit inline-block">
                    Prestasi Lainnya ->
                </a>
            </div>
        </div>
    </div>
</x-layout>