<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Prestasi Siswa</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 lg:pb-12 py-8 px-4 md:px-8 font-inter">
        <div class="flex justify-between mb-7">
            <h1 class="hidden md:block text-3xl font-bold text-stone-900">
                @if (request('search'))
                    Hasil Pencarian: "<span class="bg-yellow-200 px-1">{{ request('search') }}</span>"
                @else
                    Daftar Prestasi Siswa
                @endif
            </h1>

            <form method="GET" action="{{ route('prestasi.index') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul prestasi..."
                    class="border border-gray-300 rounded-l-xl px-4 py-2 w-full focus:outline-none focus:ring focus:border-yellow-300" />
                <button type="submit"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-r-xl hover:bg-yellow-600">
                    Cari
                </button>
            </form>
        </div>

        @if ($prestasi->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($prestasi as $item)
                    <x-prestasi-card :prestasi="$item" :lineClamp="10" />
                @endforeach
            </div>
            <div class="mt-6">
                {{ $prestasi->appends(request()->query())->links() }}
            </div>
        @else
            <div class="bg-gray-100 border border-gray-400 rounded-xl w-full text-center text-gray-500 py-8">
                Prestasi tidak ditemukan.
            </div>
        @endif
    </div>

</x-layout>