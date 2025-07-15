@props(['content'])

<div class="bg-yellow-300 text-yellow-950 py-2 lg:py-4 rounded-xl flex items-center justify-center gap-2 lg:gap-4 md:shadow-lg">
    <x-dynamic-component 
        :component="$content->icon_component"
        class="size-10 md:size-8 lg:size-10 xl:size-13 flex-shrink-0"
    />
    <div class="font-inter">
        <h1 class="line-clamp-1 font-black text-lg md:text-base lg:text-xl xl:text-2xl leading-none">{{ $content->title }}</h1>
        <p class="line-clamp-1 text-sm/3 md:text-xs xl:text-sm leading-none">{{ $content->description }}</p>
    </div>
</div>