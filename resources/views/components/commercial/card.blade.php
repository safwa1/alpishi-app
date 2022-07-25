@props([
    'url',
    'imageUrl',
    'title',
    'price',
    'releaseDate',
    'location',
    'overflowText' => 'السعر شامل ثمن السيارة وتكاليف الشحن فقط'
])

@php
    $classes = 'group relative overflow-hidden box-border transition-transform transition-all bg-white rounded-[8px] overflow-hidden cursor-pointer shadow-[0_3px_10px_rgb(0,0,0,0.2)] hover:shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px]';
    $imageClasses = 'group-hover:scale-110 transition duration-300 ease-in-out absolute object-cover w-full h-full right-0';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ $url }}">

        <!-- image-container -->
        <div class="relative overflow-hidden pb-[56.2%]">

            <!-- image -->
            <img class="{{ $imageClasses }}" src="{{ $imageUrl }}" alt="سيارة" />

            <!-- float text over image -->
            <div class="hidden absolute bottom-0 w-full p-1 bg-white/20 backdrop-blur-md transition-colors group-hover:flex">
                <span class="text-xs text-white px-2 relative text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]">
                    {{ $overflowText }}
                </span>
            </div>
        </div>

        <!-- commercial details  container -->
        <div class="px-4 py-4 box-border bg-white">

            <!-- wrapper -->
            <strong class="w-full leading-[18px] text-[12px] font-[700] text-[#484848]">

                <!--name-->
                <div
                    class="w-full relative text-ellipsis overflow-hidden pl-2 [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical] text-[14px] leading-[20px] text-[#484848]"
                    title="{{ $title }}">
                    {{ $title }}
                </div>

                <!-- price & model container -->
                <div class="flex items-center justify-between mt-3">

                    <!-- price -->
                    <span class="text-[18px] text-primary flex items-end gap-1">
                        <x-icons.dolar />
                        <span class="flex items-end">
                            {{ to_currency($price) }}
                            <span class="text-[10px] font-[400] mr-1">ريال</span>
                        </span>
                    </span>

                    <!-- release date -->
                    <span class="text-[18px] text-[coral] ml-1 flex gap-1 items-end">
                        <x-icons.date class="ml-1" />
                        {{ $releaseDate }}
                    </span>
                </div>

                <!-- location -->
                <div class="flex items-center gap-1 mt-3 text-greenify">
                    <x-icons.location />
                    <span>{{  $location }}</span>
                </div>
            </strong> <!-- end wrapper -->
        </div> <!-- End commercial-details-container -->
    </a>
</div>
