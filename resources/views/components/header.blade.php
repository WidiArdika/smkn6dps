<header x-data x-init="$store.dropdown = Alpine.reactive({ open: null })">
    <nav x-data="{ navbarOpen: false, scrollY: 0, isVisible: true }"
    x-init="
        scrollY = window.pageYOffset;
        window.addEventListener('scroll', () => {
            let current = window.pageYOffset;
            isVisible = current < scrollY || current <= 10;
            scrollY = current;
        });"
        x-effect="if (!navbarOpen) $store.dropdown.open = null"
        :class="isVisible ? 'top-0' : '-top-27'"
        class="fixed left-0 right-0 z-50 transition-all duration-300 bg-stone-900 shadow-md">

        <div class="font-inter px-33 text-stone-400 bg-stone-800 border-b-1 border-b-stone-600 hidden lg:flex items-center justify-between py-2">
            <div class="flex items-center justify-between gap-4">
                @foreach($kontak_headers as $kontak_header)
                    <x-kontak-header :kontak_header="$kontak_header" />
                @endforeach
            </div>

            <div class="flex items-center justify-between gap-4">
                <div class="hover:text-stone-50 flex items-center justify-between gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path d="M15.75 8.25a.75.75 0 0 1 .75.75c0 1.12-.492 2.126-1.27 2.812a.75.75 0 1 1-.992-1.124A2.243 2.243 0 0 0 15 9a.75.75 0 0 1 .75-.75Z" />
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM4.575 15.6a8.25 8.25 0 0 0 9.348 4.425 1.966 1.966 0 0 0-1.84-1.275.983.983 0 0 1-.97-.822l-.073-.437c-.094-.565.25-1.11.8-1.267l.99-.282c.427-.123.783-.418.982-.816l.036-.073a1.453 1.453 0 0 1 2.328-.377L16.5 15h.628a2.25 2.25 0 0 1 1.983 1.186 8.25 8.25 0 0 0-6.345-12.4c.044.262.18.503.389.676l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.575 15.6Z" clip-rule="evenodd" />
                    </svg>

                    <p class="text-xs font-semibold">{{ $tanggal_header }} - {{ $waktu_header }}</p>
                </div>
                <a href="{{ url('/admin') }}" class="hover:text-stone-50 flex items-center justify-between gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs font-semibold">Admin</p>
                </a>
            </div>
        </div>

        <div class="font-inter flex flex-wrap px-6 lg:px-33 py-4 mx-auto items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-x-3 text-l font-bold lg:tracking-wider xl:text-lg text-white uppercase">
                <img src="{{ asset('images/SMKN6.svg') }}" alt="Logo SMKN 6 Denpasar" class="lg:h-10 h-8 w-auto">
                SMK NEGERI 6 DENPASAR
            </a>

            <!-- Button mobile -->
            <button @click="navbarOpen = !navbarOpen"
                class="inline-flex items-center justify-center w-10 h-10 ml-auto text-white border-2 rounded-xl lg:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu"><path d="M4 12h16"/><path d="M4 18h16"/><path d="M4 6h16"/></svg>
            </button>

            <div :class="{'hidden': !navbarOpen, 'flex': navbarOpen}" class="w-full mt-2 lg:inline-flex lg:w-auto lg:mt-0">
                <ul class="flex flex-col w-full space-y-2 lg:w-auto lg:flex-row lg:space-y-0 lg:space-x-1">
                    <li>
                        <a href="{{ route('home') }}"
                        class="flex px-3 py-2 font-medium text-white rounded-md hover:text-yellow-300 focus:text-yellow-300">Beranda</a>
                    </li>

                    <!-- Dropdown 1 -->
                    <li class="relative" x-data>
                    <button 
                        @click.stop="$store.dropdown.open = ($store.dropdown.open === 'dropdown1' ? null : 'dropdown1')"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-white rounded-md outline-none focus:outline-none hover:text-yellow-300 focus:text-yellow-300"
                        data-dropdown-button
                        >Tentang Sekolah
                        <!-- Ikon panah -->
                        <svg 
                        class="w-4 h-4 ml-2 transition-transform duration-300"
                        :class="{'rotate-180': $store.dropdown.open === 'dropdown1'}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Mobile View -->
                    <div class="lg:hidden transition-all duration-300 ease-in-out overflow-hidden"
                        :class="$store.dropdown.open === 'dropdown1' ? 'max-h-96 mt-2' : 'max-h-0'">
                        <ul class="flex flex-col space-y-2 bg-stone-800 p-2 rounded-md shadow-inner">
                        <li><a href="{{ route('profil.sekolah') }}" class="block p-2 text-stone-300 hover:text-white">Profil Sekolah</a></li>
                        <li><a href="{{ route('profil.sekolah') }}#visi-misi" class="block p-2 text-stone-300 hover:text-white">Visi dan Misi</a></li>
                        <li><a href="{{ route('staf.guru') }}" class="block p-2 text-stone-300 hover:text-white">Staf dan Guru</a></li>
                        <li><a href="{{ route('fasilitas.index') }}" class="block p-2 text-stone-300 hover:text-white">Fasilitas Sekolah</a></li>
                        </ul>
                    </div>
                    <!-- Desktop View -->
                    <div
                        x-show="$store.dropdown.open === 'dropdown1'"
                        x-transition
                        @click.outside.window="
                        if (!$event.target.closest('[data-dropdown-button]')) {
                            $store.dropdown.open = null}"
                        class="absolute left-0 z-10 hidden w-48 mt-2 bg-stone-900 rounded-md shadow-lg lg:block"
                        data-dropdown="dropdown1">
                        <ul class="py-2">
                        <li><a href="{{ route('profil.sekolah') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Profil Sekolah</a></li>
                        <li><a href="{{ route('profil.sekolah') }}#visi-misi" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Visi dan Misi</a></li>
                        <li><a href="{{ route('staf.guru') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Staf dan Guru</a></li>
                        <li><a href="{{ route('fasilitas.index') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Fasilitas Sekolah</a></li>
                        </ul>
                    </div>
                    </li>
                    <!-- End Dropdown -->

                    <!-- Dropdown 2 -->
                    <li class="relative" x-data>
                    <button 
                        @click.stop="$store.dropdown.open = ($store.dropdown.open === 'dropdown2' ? null : 'dropdown2')"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-white rounded-md outline-none focus:outline-none hover:text-yellow-300 focus:text-yellow-300"
                        data-dropdown-button
                        >Jurusan
                        <!-- Ikon panah -->
                        <svg 
                        class="w-4 h-4 ml-2 transition-transform duration-300"
                        :class="{'rotate-180': $store.dropdown.open === 'dropdown2'}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Mobile View -->
                    <div class="lg:hidden transition-all duration-300 ease-in-out overflow-hidden"
                        :class="$store.dropdown.open === 'dropdown2' ? 'max-h-96 mt-2' : 'max-h-0'">
                        <ul class="flex flex-col space-y-2 bg-stone-800 p-2 rounded-md shadow-inner">
                            @foreach ($jurusans as $jurusan)
                                <li>
                                    <a href="{{ route('jurusan.show', ['jurusan' => $jurusan]) }}"
                                    class="block p-2 text-stone-300 hover:text-white">
                                        {{ $jurusan->nama }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Desktop View -->
                    <div
                        x-show="$store.dropdown.open === 'dropdown2'"
                        x-transition
                        @click.outside.window="
                        if (!$event.target.closest('[data-dropdown-button]')) {
                            $store.dropdown.open = null}"
                        class="absolute left-0 z-10 hidden w-81 mt-2 bg-stone-900 rounded-md shadow-lg lg:block"
                        data-dropdown="dropdown2">
                        <ul class="py-2">
                            @foreach ($jurusans as $jurusan)
                                <li>
                                    <a href="{{ route('jurusan.show', ['jurusan' => $jurusan]) }}"
                                    class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">
                                        {{ $jurusan->nama }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    </li>
                    <!-- End Dropdown -->

                    <!-- Dropdown 3 -->
                    <li class="relative" x-data>
                    <button 
                        @click.stop="$store.dropdown.open = ($store.dropdown.open === 'dropdown3' ? null : 'dropdown3')"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-white rounded-md outline-none focus:outline-none hover:text-yellow-300 focus:text-yellow-300"
                        data-dropdown-button
                        >Kesiswaan
                        <!-- Ikon panah -->
                        <svg 
                        class="w-4 h-4 ml-2 transition-transform duration-300"
                        :class="{'rotate-180': $store.dropdown.open === 'dropdown3'}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Mobile View -->
                    <div class="lg:hidden transition-all duration-300 ease-in-out overflow-hidden"
                        :class="$store.dropdown.open === 'dropdown3' ? 'max-h-96 mt-2' : 'max-h-0'">
                        <ul class="flex flex-col space-y-2 bg-stone-800 p-2 rounded-md shadow-inner">
                        <li><a href="{{ route('osis') }}" class="block p-2 text-stone-300 hover:text-white">OSIS</a></li>
                        <li><a href="{{ route('ekstrakurikuler.index') }}" class="block p-2 text-stone-300 hover:text-white">Ekstrakurikuler</a></li>
                        <li><a href="{{ route('prestasi.index') }}" class="block p-2 text-stone-300 hover:text-white">Prestasi Siswa</a></li>
                        </ul>
                    </div>
                    <!-- Desktop View -->
                    <div
                        x-show="$store.dropdown.open === 'dropdown3'"
                        x-transition
                        @click.outside.window="
                        if (!$event.target.closest('[data-dropdown-button]')) {
                            $store.dropdown.open = null}"
                        class="absolute left-0 z-10 hidden w-48 mt-2 bg-stone-900 rounded-md shadow-lg lg:block"
                        data-dropdown="dropdown3">
                        <ul class="py-2">
                        <li><a href="{{ route('osis') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">OSIS</a></li>
                        <li><a href="{{ route('ekstrakurikuler.index') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Ekstrakurikuler</a></li>
                        <li><a href="{{ route('prestasi.index') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Prestasi Siswa</a></li>
                        </ul>
                    </div>
                    </li>
                    <!-- End Dropdown -->

                    <!-- Dropdown 4 -->
                    <li class="relative" x-data>
                    <button 
                        @click.stop="$store.dropdown.open = ($store.dropdown.open === 'dropdown4' ? null : 'dropdown4')"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-white rounded-md outline-none focus:outline-none hover:text-yellow-300 focus:text-yellow-300"
                        data-dropdown-button
                        >Informasi
                        <!-- Ikon panah -->
                        <svg 
                        class="w-4 h-4 ml-2 transition-transform duration-300"
                        :class="{'rotate-180': $store.dropdown.open === 'dropdown4'}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Mobile View -->
                    <div class="lg:hidden transition-all duration-300 ease-in-out overflow-hidden"
                        :class="$store.dropdown.open === 'dropdown4' ? 'max-h-96 mt-2' : 'max-h-0'">
                        <ul class="flex flex-col space-y-2 bg-stone-800 p-2 rounded-md shadow-inner">
                        <li><a href="{{ route('berita.index') }}" class="block p-2 text-stone-300 hover:text-white">Berita dan Kegiatan</a></li>
                        <li><a href="{{ route('pengumuman.index') }}" class="block p-2 text-stone-300 hover:text-white">Pengumuman</a></li>
                        </ul>
                    </div>
                    <!-- Desktop View -->
                    <div
                        x-show="$store.dropdown.open === 'dropdown4'"
                        x-transition
                        @click.outside.window="
                        if (!$event.target.closest('[data-dropdown-button]')) {
                            $store.dropdown.open = null}"
                        class="absolute left-0 z-10 hidden w-48 mt-2 bg-stone-900 rounded-md shadow-lg lg:block"
                        data-dropdown="dropdown4">
                        <ul class="py-2">
                        <li><a href="{{ route('berita.index') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Berita dan Kegiatan</a></li>
                        <li><a href="{{ route('pengumuman.index') }}" class="block px-4 py-2 text-stone-300 hover:bg-stone-800 hover:text-white">Pengumuman</a></li>
                        </ul>
                    </div>
                    </li>
                    <!-- End Dropdown -->

                    <li>
                        <a href="{{ route('kontak.index') }}"
                        class="flex px-3 py-2 font-medium text-white rounded-md hover:text-yellow-300 focus:text-yellow-300">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>