@props(['carPhoto', 'editMode'])
@php
    try {
        $url = '';
        if(gettype($carPhoto) == 'object') {
           $url = $carPhoto->temporaryUrl();
        }
        else {
            $url = $carPhoto;
        }
       $photoStatus = true;
    } catch (RuntimeException $exception){
        $photoStatus =  false;
    }
@endphp
<x-jet-dialog-modal wire:model="managingCars" :cancelable="false">
    <x-slot name="title">
        {{$slot}}
    </x-slot>

    <x-slot name="content">
        <div>
            {{--x-data="{ model: @entangle('messageModel')}--}}
            <form method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">الشركة المصنعة</label>
                    <input
                        wire:model.lazy="carModel.brand"
                        type="text"
                        id="brand"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @if($errors->has("carModel.brand"))
                        <span class="text-error text-xs">لا يمكن ترك هذا الحقل فارغاً.</span>
                        {{--<span class="text-error text-xs">{{ $errors->first("links.{$index}.data") }}</span>--}}
                    @endif
                </div>

                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">إسم الموديل</label>
                    <input
                        wire:model.lazy="carModel.model"
                        type="text"
                        id="model"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @if($errors->has("carModel.model"))
                        <span class="text-error text-xs">{{ $errors->first("carModel.model") }}</span>
                    @endif
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">سنة التصنيع</label>
                    <input
                        wire:model.lazy="carModel.releaseDate"
                        type="number"
                        min="1900"
                        max="2099"
                        id="date"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @if($errors->has("carModel.releaseDate"))
                        <span class="text-error text-xs">{{ $errors->first("carModel.releaseDate") }}</span>
                    @endif
                </div>

                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block text-sm font-medium text-gray-700"> صورة السيارة </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                     viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label
                                        for="file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>رفع ملف الصورة</span>
                                        <input
                                            wire:model="carPhoto"
                                            wire:click="$set('carPhoto', null)"
                                            id="file-upload"
                                            name="file-upload"
                                            type="file"
                                            class="sr-only">
                                    </label>
                                    <p class="pr-1">أو إسحبه وأفلته هنا</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-3">

                        <label class="block text-sm font-medium text-gray-700"> معاينة الصورة </label>

                        <div
                            class="relative mt-1 min-h-[140px] max-h-[140px] box-border flex justify-center border-2 border-gray-300 border-dashed rounded-md overflow-hidden">

                            @if($photoStatus)
                                <x-image-blur :url="$url" />
                                <img class="w-full h-auto z-20 object-contain rounded-md" src="{{ $url }}" alt="" />
                            @else
                                <div class="text-xs font-semibold text-center py-16 text-error">
                                    إمتداد الملف غير مدعوم
                                </div>
                            @endif


                            <!-- loader -->
                            <div class="absolute inset-0 w-full h-full flex items-center justify-center"
                                 wire:loading wire:target="carPhoto">
                                <div class="flex items-center justify-center gap-4 py-16">
                                    <x-icons.loader />
                                    <span class="text-xs font-semibold text-primary opacity-75">
                                        جاري المعالجة...
                                    </span>
                                </div>
                            </div>
                        </div>
                        @if($errors->has("carPhoto"))
                            <span class="text-error text-xs">{{ $errors->first("carPhoto") }}</span>
                        @endif
                    </div>

                </div>

            </form>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="managingCancel" wire:loading.attr="disabled">
            {{ __('إلغاء') }}
        </x-jet-secondary-button>

        <x-jet-button class="mr-3" wire:click="saveCar" wire:loading.attr="disabled">
            {{ __('حفظ') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
