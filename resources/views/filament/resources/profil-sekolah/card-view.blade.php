@php
    use Illuminate\Support\Str;
@endphp

<div class="p-6 rounded-xl shadow bg-white space-y-4 border border-gray-200 
            max-w-full overflow-hidden break-words">
    <a href="{{ $record->video_url }}" target="_blank"
    class="inline-flex items-center gap-2 text-yellow-700 font-semibold hover:underline">
        <x-heroicon-o-play-circle class="w-5 h-5" />
        Lihat Video
    </a>

    <div>
        <div class="prose content-style max-w-full break-words whitespace-normal overflow-hidden">
            {!! $record->visi_misi !!}
        </div>
    </div>

    <div>
        <div class="prose content-style max-w-full break-words whitespace-normal overflow-hidden">
            {!! $record->profil !!}
        </div>
    </div>
</div>
