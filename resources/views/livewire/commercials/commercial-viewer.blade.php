<iv>
    <div class="md:px-8 px-4 py-3 md:text-base text-sm font-bold shadow">
        <nav class="w-full">
            <ol class="list-reset flex">
                <li><a href="{{ route('home') }}" class="text-primary text-sm hover:text-blue-700">الرئيسية</a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="{{ route('commercials') }}" class="text-primary text-sm hover:text-blue-700">قائمة
                        السيارات</a>
                </li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li class="text-gray-500 text-sm">{{ $commercial->getCarName() }}</li>
            </ol>
        </nav>
    </div>
    <section
        class="w-full overflow-hidden bg-white mt-2">
        <x-container>

            @if($commercial->sold)
            <div class="w-full flex justify-center items-center md:px-10 px-5 py-6 h-[24rem]">
                <div class="w-full h-[80%] border flex justify-center items-center p-2 rounded-xl">

                    <div class="w-36 h-36 rounded-full bg-red-100/60 flex justify-center items-center overflow-hidden">
                        <span class="w-48 px-2 py-2 rounded-md bg-error/10 text-error text-xl text-center z-20">
                            سيارة مٌباعة
                        </span>
                    </div>

                </div>
            </div>
            @else
            <div class="w-full md:px-10 px-5 py-6">
                <!-- image gallery -->
                <div class="w-full grid grid-cols-12 gap-2">

                    <div class="sm:col-span-9 col-span-12">
                        <div
                            class="flex w-flex h-fit rounded-lg overflow-hidden bg-gray-500 border border-2 border-gray-500">

                            <div class="w-full grid grid-rows-12">

                                <div class="row-span-10 carousel slide flex justify-center p-2 items-center relative">

                                    <x-image-blur :url="\App\Utils\FileUtil::storageUrl($currentMedia['path'])" />
                                    <img
                                        src="{{ \App\Utils\FileUtil::storageUrl($currentMedia['path']) }}"
                                        class="!h-auto max-h-[24rem] min-h-[18rem] object-contain rounded-md cursor-zoom-in z-20"
                                        alt="" />

                                    <button
                                        wire:click="next"
                                        class="z-20 carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                                        type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    <button
                                        wire:click="previous"
                                        class="z-20 carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                                        type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                        <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                </div>

                                <div class="row-span-2 overflow-hidden">
                                    <div
                                        class="w-full whitespace-nowrap bg-gray-600 grid auto-cols-max grid-flow-col px-1 py-2 gap-1 overflow-x-auto over scroll-smooth scrollbar-hide sm:scrollbar-default snap-x snap-mandatory scroll-px-2">
                                        @foreach($commercialMedia as $index => $media)
                                            <div
                                                wire:click="changeCurrentMedia({{$index}})"
                                                class="min-w-[9rem] w-36 h-24 border border-gray-300 bg-gray-300 sm:border-4 border-2 border-gray-400 @if($currentMediaIndex == $index) border-primary @endif rounded-md cursor-pointer overflow-hidden snap-start">
                                                <img
                                                    class="w-full h-full object-cover"
                                                    src="{{ \App\Utils\FileUtil::storageUrl($media['path'])}}"
                                                    alt=""
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="sm:col-span-3 col-span-12 p-2 border border-gray-200 rounded-lg">

                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <div
                                class="text-primary text-sm font-semibold px-2 mb-2">
                                الشركة المصنعة
                            </div>
                            <div
                                class="text-sm px-3 py-2 bg-gray-50 border border-1 border-gray-200 opacity-70 text-neutral-800 sm:rounded-lg rounded-md">
                                {{$commercial->getCarBrand()}}
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <div
                                class="text-primary text-sm font-semibold px-2 mb-2">
                                إسم الموديل
                            </div>
                            <div
                                class="text-sm px-3 py-2 bg-gray-50 border text-neutral-800 opacity-70 border-1 border-gray-200 sm:rounded-lg rounded-md">
                                {{$commercial->getCarName()}}
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <div
                                class="text-primary text-sm font-semibold px-2 mb-2">
                                سنة التصنيع
                            </div>
                            <div class="px-3 py-2 bg-gray-50 border border-1 border-gray-200 sm:rounded-lg rounded-md">
                                <span class="text-sm text-neutral-800 opacity-70 flex gap-3">
                                    <x-icons.date />
                                    <span>{{$commercial->getCarReleaseDate()}}</span>
                                </span>
                            </div>
                        </div>

                        <div class="pb-4 mb-4">
                            <div
                                class="text-primary text-sm font-semibold px-2 mb-2">
                                موقع السيارة
                            </div>
                            <div class="px-3 py-2 bg-gray-50 border border-1 border-gray-200 sm:rounded-lg rounded-md">
                                <div class="text-sm flex items-center gap-3 text-neutral-800 opacity-70">
                                    <x-icons.location />
                                    {{$commercial->location}}
                                </div>
                            </div>
                        </div>

                        <div class="pb-4 mb-4 px-3">
                            <a href="{{$whatsappUrl}}" target="_blank">
                                <button
                                    class="group cursor-pointer bg-[#128c7e] text-sm focus:ring-4 hover:ring-4 focus:ring-[#a0d1cb] hover:ring-[#a0d1cb] hover:bg-[#107e71] active:bg-[#107e71] px-6 py-2.5 rounded-full text-[#a0d1cb] hover:text-[#e7f3f2]"
                                    type="button">
                                    <div class="flex items-center gap-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                        </svg>
                                        <span class="text-[#cfe8e5] group-hover:text-[#e7f3f2] duration-300">
                                        إحـجــــــزهــا الأن
                                    </span>
                                    </div>
                                </button>
                            </a>
                        </div>

                    </div>

                </div>
                <!-- description -->
                <div class="sm:mt-8 mt-3 sm:p-0 p-2">

                    <div class="">
                        <div
                            class="text-primary text-sm font-semibold border-r border-r-[3px] border-r-primary px-2 mb-4">
                            تفاصيل السيارة
                        </div>

                        <div class="grid grid-cols-12 gap-3">

                            <div class="sm:col-span-3 col-span-12 mb-4">
                                <div
                                    class="text-sm bg-gray-50 border border-1 border-primary/40 rounded-md flex items-center justify-between overflow-hidden">
                                    <span class="bg-primary text-white text-sm h-full relative px-4 py-3">
                                        السعر
                                    </span>
                                    <span class="text-[18px] text-blue-500 self-end flex items-end gap-2  px-4 py-3">
                                        <span class="flex items-end">
                                            {{ to_currency($commercial->price) }}
                                            <span class="text-[10px] font-[400] mr-1.5">ريال</span>
                                        </span>
                                    </span>
                                    <span class="bg-neutral-100 text-primary text-sm h-full relative px-4 py-3">
                                        <x-icons.dolar />
                                    </span>
                                </div>
                            </div>

                            <div class="sm:col-span-3 col-span-12 mb-4">
                                <div
                                    class="text-sm bg-gray-50 border border-1 border-greenify/40 rounded-md flex items-center justify-between overflow-hidden">
                                    <span class="bg-greenify text-white text-sm h-full relative px-4 py-3">
                                        التكاليف
                                    </span>
                                    <span class="text-[18px] text-greenify self-end flex items-end gap-2  px-4 py-3">

                                        <span class="flex items-end">
                                            {{ to_currency($commercial->cost) }}
                                            <span class="text-[10px] font-[400] mr-1.5">ريال</span>
                                        </span>
                                    </span>
                                    <span class="bg-neutral-100 text-greenify text-sm h-full relative px-4 py-3">
                                        <x-icons.cash />
                                    </span>
                                </div>
                            </div>

                            <div class="sm:col-span-3 col-span-12 mb-4">
                                <div
                                    class="text-sm bg-gray-50 border border-1 border-error/40 rounded-md flex items-center justify-between overflow-hidden">
                                    <span class="bg-error text-white text-sm h-full relative px-4 py-3">
                                        الإجمالي
                                    </span>
                                    <span class="text-[18px] text-error self-end flex items-end gap-2  px-4 py-3">

                                        <span class="flex items-end">
                                            {{ to_currency(floatval($commercial->price) + floatval($commercial->cost)) }}
                                            <span class="text-[10px] font-[400] mr-1.5">ريال</span>
                                        </span>
                                    </span>
                                    <span class="bg-neutral-100 text-error text-sm h-full relative px-4 py-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="sm:col-span-3 col-span-12 mb-4">
                                <div
                                    class="text-sm bg-gray-50 border border-1 border-warning/40 rounded-md flex items-center justify-between overflow-hidden">
                                    <span class="bg-warning text-white text-sm h-full relative px-4 py-3">
                                        العداد
                                    </span>
                                    <span class="text-[18px] text-warning self-end flex items-end gap-2  px-4 py-3">
                                        <span class="flex items-end">
                                           {{ $commercial->counter }}
                                        </span>
                                    </span>
                                    <span class="bg-neutral-100 text-warning text-sm h-full relative px-4 py-3">
                                        <x-icons.meter />
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="px-4 py-2 bg-orange-300/40 border border-2 border-orange-300 rounded-md text-sm">
                            <span class="text-orange-500 opacity-80">
                                السعر الإجمالي شامل قيمة السيارة وتكلفة الشحن للدمام فقط ولا يشمل رسوم الجمرك والضريبة ومصاريف الميناء.
                            </span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div
                            class="text-primary text-sm font-semibold border-r border-r-[3px] border-r-primary px-2 mb-4">
                            وصف السيارة
                        </div>

                        <div class="mt-4 border border-1 border-gray-200 rounded-md">
                            <div class="px-4 py-4 opacity-95">
                                @foreach($commercial->getDescriptionLines() as $line)
                                    <div class="flex items-center gap-6 text-green-600 bg-green-100/60 py-2 px-2.5 mb-2 sm:rounded-lg rounded-md sm:text-base text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $line }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </x-container>
    </section>
</iv>
