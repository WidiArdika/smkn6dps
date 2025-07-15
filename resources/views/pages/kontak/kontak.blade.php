<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Informasi Kontak</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 lg:pb-12 py-8 px-4 md:px-8 font-inter bg-stone-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-8 lg:gap-12 bg-white p-8 rounded-2xl">
            <div class="text-stone-900">
                <div class="w-fit mb-5">
                    <h1 class="font-bold text-2xl lg:text-3xl">Informasi Kontak Kami</h1>
                    <div class="bg-yellow-500 w-full h-1 rounded-full"></div>
                </div>
                {{-- Alamat --}}
                <div class="flex gap-6 mb-3 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-700 size-6 shrink-0">
                        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-bold">Alamat :</p>
                        <p class="text-sm">{{ $kontak?->alamat ?? '-' }}</p>
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="flex gap-6 mb-3 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-700 size-6 shrink-0">
                        <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-bold">Telepon :</p>
                        <p class="text-sm">{{ $kontak?->telepon ?? '-' }}</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="flex gap-6 mb-3 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-700 size-6 shrink-0">
                        <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                        <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                    </svg>
                    <div>
                        <p class="font-bold">Email :</p>
                        <p class="text-sm">{{ $kontak?->email ?? '-' }}</p>
                    </div>
                </div>

                {{-- Hari Kerja --}}
                <div class="flex gap-6 mb-3 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-700 size-6 shrink-0">
                        <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                        <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-bold">Hari Kerja :</p>
                        <p class="text-sm">{{ $kontak?->hari_kerja ?? '-' }}</p>
                    </div>
                </div>

                {{-- Jam Kerja --}}
                <div class="flex gap-6 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-700 size-6 shrink-0">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-bold">Jam Kerja :</p>
                        <p class="text-sm">{{ $kontak?->jam_kerja ?? '-' }}</p>
                    </div>
                </div>

                {{-- Sosial Media --}}
                <div class="mb-7">
                    <div class="mt-5 bg-stone-200 w-full h-0.5 rounded-full"></div>
                    <div class="flex mt-5 -mx-2">

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

                        <a href="{{ $igLink }}" class="mx-2.5 hover:text-yellow-700" target="_blank" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M13.61 12.243a1.6 1.6 0 1 1-1.56-1.63a1.62 1.62 0 0 1 1.56 1.63" />
                                <path fill="currentColor" d="M14.763 7.233H9.338a2.024 2.024 0 0 0-2.024 2.024v5.547a2.024 2.024 0 0 0 2.024 2.024h5.425a2.024 2.024 0 0 0 2.024-2.024V9.267a2.026 2.026 0 0 0-2.024-2.034m-2.713 7.723a2.703 2.703 0 1 1 2.642-2.703a2.67 2.67 0 0 1-2.642 2.703m2.936-5.405a.496.496 0 0 1-.496-.506a.506.506 0 1 1 1.012 0a.496.496 0 0 1-.557.506z" />
                                <path fill="currentColor" d="M12.05 2a10 10 0 1 0-.1 20a10 10 0 0 0 .1-20m6.073 12.702a3.39 3.39 0 0 1-3.41 3.411H9.389a3.39 3.39 0 0 1-3.411-3.41V9.378a3.39 3.39 0 0 1 3.41-3.411h5.325a3.39 3.39 0 0 1 3.41 3.41z" />
                            </svg>
                        </a>

                        <a href="{{ $fbLink }}"
                            class="mx-2.5 hover:text-yellow-700" target="_blank" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12.001 2c-5.523 0-10 4.477-10 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89c1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.344 21.129 22 16.992 22 12c0-5.523-4.477-10-10-10" />
                            </svg>
                        </a>

                        <a href="{{ $ttLink }}"
                            class="mx-2.5 hover:text-yellow-700" target="_blank" aria-label="TikTok">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2a10 10 0 1 0 10 10A10.01 10.01 0 0 0 12 2m5.939 7.713v.646a.37.37 0 0 1-.38.37a5.36 5.36 0 0 1-2.903-1.108v4.728a3.94 3.94 0 0 1-1.18 2.81a4 4 0 0 1-2.87 1.17a4.1 4.1 0 0 1-2.862-1.17a3.98 3.98 0 0 1-1.026-3.805c.159-.642.48-1.232.933-1.713a3.58 3.58 0 0 1 2.79-1.313h.82v1.703a.348.348 0 0 1-.39.348a1.918 1.918 0 0 0-1.23 3.631c.27.155.572.246.882.267c.24.01.48-.02.708-.092a1.93 1.93 0 0 0 1.313-1.816V5.754a.36.36 0 0 1 .359-.36h1.415a.36.36 0 0 1 .359.34a3.3 3.3 0 0 0 1.282 2.245a3.25 3.25 0 0 0 1.641.636a.37.37 0 0 1 .338.35z" />
                            </svg>
                        </a>

                        <a href="{{ $ytLink }}"
                            class="mx-2.5 hover:text-yellow-700 mt-0.5" target="_blank" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 20 20">
                                <path fill="currentColor" d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4m0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9s5 .443 5 3.9s-.086 3.9-5 3.9" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
            <div>
                @if ($kontak && $kontak->google_maps_embed)
                    <iframe class="aspect-square md:aspect-auto w-full h-full rounded-xl shadow-lg"
                        src="{{ $kontak->google_maps_embed }}"
                        title="Peta Lokasi Sekolah"
                        frameborder="0"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                @else
                    <div class="text-center text-sm text-stone-400 italic">
                        Lokasi Google Maps belum tersedia.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>