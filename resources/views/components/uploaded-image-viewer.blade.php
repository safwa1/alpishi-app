@props(['photo', 'index' => ''])

@php
    $classes = 'relative group w-full min-h-[194px] max-h-[194px] box-border flex justify-center sm:border-2 sm:border-gray-300 rounded-md overflow-hidden cursor-pointer bg-gray-300';
    $photo = gettype($photo) == 'array' ? $photo['path'] : $photo;
    $url = gettype($photo) == 'object'
    ? \App\Utils\FileUtil::tempUrlOf($photo)
    : \App\Utils\FileUtil::storageUrl($photo);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>

    <!-- viewer -->
    <x-image-blur :url="$url" />
    <img class="w-full h-auto z-20 object-contain rounded-md" src="{{ $url }}" alt="" />

    <button
        wire:click="removeUploadedImage({{$index}})"
        class="hidden group-hover:block z-20 absolute top-2 left-2 flex justify-between items-center p-1 sm:p-1.5 text-sm font-medium leading-5 bg-gray-100 text-neutral-500 focus:outline-none focus:shadow-outline-gray hover:bg-gray-200/80 rounded-lg hover:rounded-lg"
        aria-label="add cards"
        title="add cards">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"
            />
        </svg>
    </button>

    <div class="hidden group-hover:block w-full bg-white text-xs opacity-75 absolute bottom-0 left-0 backdrop-blur-md text-white z-20 px-2 py-1">
        <span
            class="max-w-full text-ellipsis overflow-hidden text-left [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical] text-warning drop-shadow-lg shadow-black"
            title="{{ \App\Utils\FileUtil::nameOf($photo) }}">
            {{ \App\Utils\FileUtil::nameOf($photo) }}
        </span>
    </div>

    <!-- loader -->
    <div class="absolute inset-0 w-full h-full flex items-center justify-center"
         wire:loading wire:target="photo">
        <div class="flex items-center justify-center gap-4 py-16">
            <x-icons.loader />
            <span class="text-xs font-semibold text-primary opacity-75">
                جاري المعالجة...
            </span>
        </div>
    </div>
</div>
