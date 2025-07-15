<footer class="bg-stone-900 ">
    <div class=" px-6 lg:px-33 pt-12 pb-6 mx-auto font-inter">
        <div class="lg:flex">
            <div class="w-full -mx-6 lg:w-2/5">
                <div class="px-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-x-3 text-lg font-bold lg:tracking-wider lg:text-xl 2xl:text-2xl text-white uppercase">
                        <img src="{{ asset('images/SMKN6.svg') }}" alt="Logo SMKN 6 Denpasar" class="h-10 w-auto">
                        SMK NEGERI 6 DENPASAR
                    </a>
                    <p class="line-clamp-4 lg:line-clamp-3 max-w-sm mt-2 lg:mr-12 text-justify text-white">{{ $profile_info->deskripsi ?? '-' }}</p>

                    @php
                        $igUsername = ltrim($kontak?->instagram ?? '', '@');
                        $fbUsername = ltrim($kontak?->facebook ?? '', '@');
                        $ttUsername = ltrim($kontak?->tiktok ?? '', '@');
                        $ytUsername = ltrim($kontak?->youtube ?? '', '@');

                        $igLink = $igUsername ? "https://www.instagram.com/{$igUsername}" : "#";
                        $fbLink = $fbUsername ? "https://www.facebook.com/{$fbUsername}" : "#";
                        $ttLink = $ttUsername ? "https://www.tiktok.com/@{$ttUsername}" : "#";
                        $ytLink = $ytUsername ? "https://www.youtube.com/@{$ytUsername}" : "#";
                    @endphp

                    <div class="flex mt-6 lg:mt-4 -mx-2">
                        <a href="{{ $igLink }}"
                            class="mx-2.5 text-white transition-colors duration-300 hover:text-yellow-300"
                            aria-label="Instgram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M13.61 12.243a1.6 1.6 0 1 1-1.56-1.63a1.62 1.62 0 0 1 1.56 1.63" />
                                <path fill="currentColor" d="M14.763 7.233H9.338a2.024 2.024 0 0 0-2.024 2.024v5.547a2.024 2.024 0 0 0 2.024 2.024h5.425a2.024 2.024 0 0 0 2.024-2.024V9.267a2.026 2.026 0 0 0-2.024-2.034m-2.713 7.723a2.703 2.703 0 1 1 2.642-2.703a2.67 2.67 0 0 1-2.642 2.703m2.936-5.405a.496.496 0 0 1-.496-.506a.506.506 0 1 1 1.012 0a.496.496 0 0 1-.557.506z" />
                                <path fill="currentColor" d="M12.05 2a10 10 0 1 0-.1 20a10 10 0 0 0 .1-20m6.073 12.702a3.39 3.39 0 0 1-3.41 3.411H9.389a3.39 3.39 0 0 1-3.411-3.41V9.378a3.39 3.39 0 0 1 3.41-3.411h5.325a3.39 3.39 0 0 1 3.41 3.41z" />
                            </svg>
                        </a>
                    
                        <a href="{{ $fbLink }}"
                            class="mx-2.5 text-white transition-colors duration-300 hover:text-yellow-300"
                            aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12.001 2c-5.523 0-10 4.477-10 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89c1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.344 21.129 22 16.992 22 12c0-5.523-4.477-10-10-10" />
                            </svg>
                        </a>
                    
                        <a href="{{ $ttLink }}"
                            class="mx-2.5 text-white transition-colors duration-300 hover:text-yellow-300"
                            aria-label="Tiktok">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2a10 10 0 1 0 10 10A10.01 10.01 0 0 0 12 2m5.939 7.713v.646a.37.37 0 0 1-.38.37a5.36 5.36 0 0 1-2.903-1.108v4.728a3.94 3.94 0 0 1-1.18 2.81a4 4 0 0 1-2.87 1.17a4.1 4.1 0 0 1-2.862-1.17a3.98 3.98 0 0 1-1.026-3.805c.159-.642.48-1.232.933-1.713a3.58 3.58 0 0 1 2.79-1.313h.82v1.703a.348.348 0 0 1-.39.348a1.918 1.918 0 0 0-1.23 3.631c.27.155.572.246.882.267c.24.01.48-.02.708-.092a1.93 1.93 0 0 0 1.313-1.816V5.754a.36.36 0 0 1 .359-.36h1.415a.36.36 0 0 1 .359.34a3.3 3.3 0 0 0 1.282 2.245a3.25 3.25 0 0 0 1.641.636a.37.37 0 0 1 .338.35z" />
                            </svg>
                        </a>

                        <a href="{{ $ytLink }}"
                            class=" mt-0.5 mx-2.5 text-white transition-colors duration-300 hover:text-yellow-300"
                            aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 20 20">
                                <path fill="currentColor" d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4m0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9s5 .443 5 3.9s-.086 3.9-5 3.9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6 lg:mt-0 lg:flex-1">
                <div class="grid grid-cols-2 gap-6 sm:grid-cols-2 md:grid-cols-4">                    

                    <div>
                        <h3 class="text-white font-bold">Tentang Sekolah</h3>
                        <hr class="text-yellow-300 w-9 my-3">
                        <a href="{{ route('profil.sekolah') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Profil Sekolah</a>
                        <a href="{{ route('profil.sekolah') }}#visi-misi" class="block mt-2 text-sm text-stone-300 hover:text-white">Visi dan Misi Sekolah</a>
                        <a href="{{ route('staf.guru') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Staf dan Guru</a>
                        <a href="{{ route('fasilitas.index') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Fasilitas Sekolah</a>
                    </div>

                    <div>
                        <h3 class="text-white font-bold">Kesiswaan</h3>
                        <hr class="text-yellow-300 w-9 my-3">
                        <a href="{{ route('osis') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Struktur OSIS</a>
                        <a href="{{ route('ekstrakurikuler.index') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Daftar Ekstrakurikuler</a>
                        <a href="{{ route('prestasi.index') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Daftar Prestasi Siswa</a>
                    </div>

                    <div>
                        <h3 class="text-white font-bold">Informasi</h3>
                        <hr class="text-yellow-300 w-9 my-3">
                        <a href="{{ route('berita.index') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Berita dan Kegiatan</a>
                        <a href="{{ route('pengumuman.index') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Pengumuman Sekolah</a>
                        <a href="{{ route('kontak.index') }}" class="block mt-2 text-sm text-stone-300 hover:text-white">Kontak Kami</a>
                    </div>

                    <div>
                        <h3 class="text-white font-bold">Kontak</h3>
                        <hr class="text-yellow-300 w-9 my-3">
                        <p class="mt-2 text-sm text-stone-300 hover:text-white">{{ $kontak->telepon ?? '-' }}</p>
                        <p class="mt-2 text-sm text-stone-300 hover:text-white">{{ $kontak->email ?? '-' }}</p>
                        <p class="mt-2 text-sm text-stone-300 hover:text-white line-clamp-3">{{ $kontak->alamat ?? '-' }}</p>
                    </div>

                </div>
            </div>
        </div>

        <hr class="h-px my-6 bg-stone-700 border-none">

        <div>
            <p class="text-center text-xs text-white font-light">Copyright © {{ $tahun_copyright }} SMK Negeri 6 Denpasar. All Right Reserved.</p>
        </div>
    </div>
</footer>