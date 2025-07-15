<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Profil Sekolah</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 lg:py-12 py-8 lg:bg-stone-100 font-inter">
        @php
            $data = \App\Models\ProfilSekolah::first();
        @endphp
        @if ($data)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:p-10 rounded-2xl gap-4 lg:gap-8 bg-white">

                <div class="px-8 lg:px-0">
                    <div class="content-style">
                        {!! $data->profil !!}
                    </div>
                </div>
                <div>
                    <div class="px-8 lg:px-0 mb-4 lg:mb-8">
                        <iframe class="w-full aspect-video rounded-xl" src="{{ $data->video_url }}" 
                            title="YouTube video" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div id="visi-misi" class="h-full content-style px-8 lg:px-0">
                        {!! $data->visi_misi !!}
                    </div>
                </div>

            </div>
        @else
            <div class="p-4 bg-red-100 text-red-600 font-semibold">
                Belum ada data profil sekolah. Admin belum menambahkan data pada profil sekolah.
            </div>
        @endif
    </div>
</x-layout>