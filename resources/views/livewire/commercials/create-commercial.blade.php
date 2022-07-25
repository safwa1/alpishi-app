<x-slot name="header">
    <nav class="w-full">
        <ol class="list-reset flex">
            <li>
                <a href="{{ route('manage-commercials') }}" class="text-blue-600 hover:text-blue-700">
                    <h2 class="font-semibold text-lg leading-tight">
                        إدارة العروض
                    </h2>
                </a>
            </li>
            <li><span class="text-gray-500 mx-2">/</span></li>
            <li class="text-gray-500">
                <h2 class="font-semibold text-lg leading-tight">
                    {{ $mode == 'create' ? 'جديد' : 'تعديل' }}
                </h2>
            </li>
        </ol>
    </nav>
</x-slot>


<div class="py-12 overflow-x-hidden">

    <x-loading-layer wire:loading wire:target="createNewCommercial" />

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 space-y-8">
            <!-- select car -->
            <div class="border-b pb-4 overflow-hidden">

                <!-- title -->
                <div class="text-primary text-sm font-semibold border-r border-r-[3px] border-r-primary px-2 mb-4">
                    حدد سيارة
                </div>

                <!-- container -->
                <div class="space-y-4">

                    <!-- content -->
                    <div class="grid grid-cols-12 gap-4">

                        <!-- cars list -->
                        <div class="col-span-12 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700">
                                السيارات المتاحة
                                <select
                                    dir="ltr"
                                    wire:model="selectedCar.id"
                                    wire:change="carChanged"
                                    class="mt-1 block w-full border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($cars as $index => $car)
                                        <option value="{{$car['id']}}">{{$car['model']}}</option>
                                    @endforeach
                                </select>
                            </label>
                            @if($errors->has("commercial.car_id"))
                                <span class="text-error text-xs">{{ $errors->first("commercial.car_id") }}</span>
                            @endif
                        </div>

                        <!-- car information -->
                        <div class="col-span-12 sm:col-span-4 space-y-4">
                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700">
                                    الشركة المصنعة
                                </label>
                                <input
                                    wire:model.lazy="selectedCar.brand"
                                    type="text"
                                    id="brand"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    disabled>
                            </div>

                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700">إسم الموديل</label>
                                <input
                                    wire:model.lazy="selectedCar.model"
                                    type="text"
                                    id="model"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    disabled>
                            </div>

                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">سنة التصنيع</label>
                                <input
                                    wire:model.lazy="selectedCar.releaseDate"
                                    type="number"
                                    min="1900"
                                    max="2099"
                                    id="date"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    disabled>
                            </div>
                        </div>

                        <!-- car photo -->
                        <div class="col-span-12 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700"> الصورة </label>
                            <div
                                class="relative mt-1 min-h-[194px] max-h-[194px] box-border flex justify-center border-2 border-gray-300 border-dashed rounded-md overflow-hidden">

                                @if(isset($selectedCar['mediable']['path']))
                                    <x-image-blur
                                        :url="\Illuminate\Support\Facades\Storage::url($selectedCar['mediable']['path'])" />
                                    <img class="w-full h-auto z-20 object-contain rounded-md"
                                         src="{{ \Illuminate\Support\Facades\Storage::url($selectedCar['mediable']['path']) }}"
                                         alt="" />
                                @else
                                    <div class="text-xs font-semibold text-center py-16 text-error">
                                        بدون صورة
                                    </div>
                                @endif
                                <!-- loader -->
                                <div class="absolute inset-0 w-full h-full flex items-center justify-center"
                                     wire:loading wire:target="selectedCar">
                                    <div class="flex items-center justify-center gap-4 py-16">
                                        <x-icons.loader />
                                        <span class="text-xs font-semibold text-primary opacity-75">
                                        جاري المعالجة...
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div> <!-- end car information -->

            <!-- commercials information -->
            <div class="border-b pb-4 overflow-hidden">

                <!-- title -->
                <div class="text-primary text-sm font-semibold border-r border-r-[3px] border-r-primary px-2 mb-4">
                    تفاصيل العرض
                </div>

                <!-- container -->
                <div class="space-y-4">

                    <!-- content -->
                    {{-- 'car_id', 'price', 'counter', 'cost', 'sold', 'description', 'location' --}}
                    <div class="grid grid-cols-12 gap-4">

                        <div class="col-span-12 sm:col-span-6 space-y-4">
                            <!-- price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">السعر</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm"> $ </span>
                                    </div>
                                    <input
                                        wire:model.lazy="commercial.price"
                                        type="number"
                                        id="price"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md text-left"
                                        placeholder="0.00" />
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                        <label for="currency" class="sr-only">Currency</label>
                                        <select id="currency" name="currency"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>SAR</option>
                                            <option>USD</option>
                                            <option>CAD</option>
                                            <option>EUR</option>
                                        </select>
                                    </div>
                                </div>
                                @if($errors->has("commercial.price"))
                                    <span class="text-error text-xs">{{ $errors->first("commercial.price") }}</span>
                                @endif
                            </div>

                            <!-- counter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    العداد
                                    <input
                                        wire:model.lazy="commercial.counter"
                                        type="text"
                                        min="0"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        placeholder="0 كيلو متر">
                                </label>
                                @if($errors->has("commercial.counter"))
                                    <span class="text-error text-xs">{{ $errors->first("commercial.counter") }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-6 space-y-4">
                            <!-- cost -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">التكاليف</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm"> $ </span>
                                    </div>
                                    <input
                                        wire:model.lazy="commercial.cost"
                                        type="number"
                                        id="price"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md text-left"
                                        placeholder="0.00" />
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                        <label for="currency" class="sr-only">Currency</label>
                                        <select id="currency" name="currency"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>SAR</option>
                                            <option>USD</option>
                                            <option>CAD</option>
                                            <option>EUR</option>
                                        </select>
                                    </div>
                                </div>
                                @if($errors->has("commercial.cost"))
                                    <span class="text-error text-xs">{{ $errors->first("commercial.cost") }}</span>
                                @endif
                            </div>

                            <!-- location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    موقع السيارة
                                    <input
                                        wire:model.lazy="commercial.location"
                                        type="text"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        placeholder="كوريا، جدة، الميناء...">
                                </label>
                                @if($errors->has("commercial.location"))
                                    <span class="text-error text-xs">{{ $errors->first("commercial.location") }}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <!-- description -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">
                            الوصف
                        </label>
                        <div class="mt-1">
                        <textarea
                            wire:model.lazy="commercial.description"
                            id="message"
                            rows="8"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>
                        @if($errors->has("commercial.description"))
                            <span class="text-error text-xs">{{ $errors->first("commercial.description") }}</span>
                        @endif
                    </div>

                </div>


            </div>

            <!-- commercials photos -->
            <div class="pb-4 overflow-hidden">

                <!-- title -->
                <div class="text-primary text-sm font-semibold border-r border-r-[3px] border-r-primary px-2 mb-4">
                    صور العرض
                </div>

                <div class="border rounded-md">

                    <!-- gallery -->
                    <div class="h-max min-h-[22rem] max-h-[22rem] grid grid-rows-6">

                        <!-- images gallery -->
                        <div class="row-span-6 w-full overflow-x-hidden overflow-y-auto relative">

                            <!-- loader -->
                            <div class="absolute inset-0 w-full h-full flex items-center justify-center"
                                 wire:loading wire:target="commercialMediables">
                                <div class="flex items-center justify-center gap-4 py-20">
                                    <x-icons.loader class="text-error" />
                                    <span class="text-xs font-semibold text-error opacity-75">
                                    جاري المعالجة...
                                </span>
                                </div>
                            </div>

                            <!-- displaying images -->
                            <div class="w-full grid grid-cols-12 gap-2 p-0.5 sm:p-2">
                                @if(isset($commercialMediables))
                                    @foreach($commercialMediables as $index => $photo)
                                        <div class="col-span-12 sm:col-span-3">
                                            <x-uploaded-image-viewer :photo="$photo" :index="$index" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>

                    </div>

                    <!-- upload input -->
                    <div class="flex justify-center px-6 pt-5 pb-6 border-t-2 border-gray-300 border-dashed">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400"
                                 stroke="currentColor"
                                 fill="none"
                                 viewBox="0 0 48 48"
                                 aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label
                                    for="file-upload"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>إختيار الملفات</span>
                                    @if($mode == 'create')
                                        <input
                                            wire:model.lazy="commercialMediables"
                                            id="file-upload"
                                            name="file-upload"
                                            type="file"
                                            class="sr-only"
                                            multiple
                                        >
                                    @else
                                        <input
                                            wire:model.lazy="commercialMediablesForUploading"
                                            id="file-upload"
                                            name="file-upload"
                                            type="file"
                                            class="sr-only"
                                            multiple
                                        >
                                    @endif
                                </label>
                                <p class="pr-1">أو إسحبها وأفلتها هنا</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
                @if($errors->has("commercialMediables"))
                    <span class="text-error text-xs">{{ $errors->first("commercialMediables") }}</span>
                @endif
            </div>

            <div class="flex flex-row justify-end px-4 py-3 bg-gray-100 text-right rounded-md">
                <x-jet-button
                    wire:click="modifyCommercial"
                    wire:loading.attr="disabled">
                    {{ __('حفظ') }}
                </x-jet-button>
            </div>
        </div>
    </div>
</div>
