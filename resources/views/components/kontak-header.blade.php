@props(['kontak_header'])

<div class="hover:text-stone-50 flex items-center justify-between gap-1.5">
    <x-dynamic-component 
        :component="$kontak_header->icon_component"
        class="size-4"
    />
    <p class="text-xs font-semibold">{{ $kontak_header->title }}</p>
</div>