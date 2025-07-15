<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Pengumuman</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="hidden lg:block w-full lg:px-45 lg:pt-12 py-8 px-4 font-inter">
        <h1 class="hidden lg:block mb-7 text-3xl font-bold text-stone-900">Daftar Pengumuman Terkini</h1>
        <div class="grid grid-cols-3 gap-4">
                <x-pengumuman-card :pengumuman="$pengumumanPertama" :lineClamp="5" :textSize="'4xl'" class="col-span-2" />
                <x-pengumuman-card :pengumuman="$pengumumanKedua" :lineClamp="18" :textSize="'2xl'" />
        </div>
    </div>

    <div id="hasil-pencarian" class="w-full lg:px-45 lg:pb-12 py-8 px-4 md:px-8 font-inter">
        <div class="flex justify-between mb-7">
            <h1 class="hidden md:block text-3xl font-bold text-stone-900">
                @if (request('search'))
                    Hasil Pencarian: "<span class="bg-yellow-200 px-1">{{ request('search') }}</span>"
                @else
                    Daftar Pengumuman
                @endif
            </h1>

            <form method="GET" action="{{ route('pengumuman.index') }}#hasil-pencarian" class="flex">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul pengumuman..." 
                    class="border border-gray-300 rounded-l-xl px-4 py-2 w-full focus:outline-none focus:ring focus:border-yellow-300" />
                <button type="submit" 
                    class="bg-yellow-500 text-white px-4 py-2 rounded-r-xl hover:bg-yellow-600">
                    Cari
                </button>
            </form>
        </div>

        @if ($pengumuman->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($pengumuman as $item)
                    <x-pengumuman-card :pengumuman="$item"/>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $pengumuman->appends(request()->query())->fragment('hasil-pencarian')->links() }}
            </div>
        @else
            <div class="bg-gray-100 border border-gray-400 rounded-xl w-full text-center text-gray-500 py-8">
                Pengumuman tidak ditemukan.
            </div>
        @endif
    </div>

</x-layout>