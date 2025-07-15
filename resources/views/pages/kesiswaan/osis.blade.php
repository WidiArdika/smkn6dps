<x-layout>
    <div class="bg-yellow-100 w-full h-34 lg:h-44 lg:px-45 font-inter">
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
        
        <div class="text-center py-7 lg:py-11 bg-gradient-to-r from-yellow-400/0 from-0% via-yellow-400/100 to-yellow-400/0 to-100%">
            <h1 class="font-black text-4xl lg:text-5xl text-yellow-950">Struktur OSIS</h1>
            <p class="text-lg font-medium text-yellow-950">SMK Negeri 6 Denpasar</p>
        </div>
        
        <div class="bg-gradient-to-r from-white/0 from-0% via-white/100 to-white/0 to-100% h-1.5"></div>
    </div>

    <div class="w-full lg:px-45 lg:pb-12 py-8 px-4 md:px-8 font-inter">
        <h1 class="mb-3 md:mb-7 md:text-3xl text-xl font-bold text-stone-900">Struktur OSIS {{ $osis->periode ?? '' }}</h1>
        @if ($osis && $osis->anggota && count($osis->anggota) > 0)
            <table class="w-full border-separate border md:table-fixed border-gray-400 text-center">
                <thead class="bg-yellow-300 text-yellow-950">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($osis->anggota as $anggota)
                        <tr class="bg-white even:bg-stone-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $anggota['nama'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $anggota['jabatan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-10 px-6 text-stone-600 bg-yellow-50 rounded-lg shadow border">
                <p class="text-lg font-semibold">Belum ada data struktur OSIS yang tersedia.</p>
                <p class="text-sm">Admin mungkin belum menambahkan data untuk periode ini.</p>
            </div>
        @endif
    </div>
</x-layout>