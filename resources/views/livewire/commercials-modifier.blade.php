@php
    // 'car_id', 'price', 'counter', 'cost', 'sold', 'description', 'location'
    $columnHeaders = [
        '',
        'السيارة',
        'السعر',
        'العداد',
        'التكاليف',
        'الوصف',
        'موقع السيارة',
        'الحالة',
    ];
@endphp

<div>
    @if(!empty($commercials))
        <x-table.container>
            <x-table.new :column-headers="$columnHeaders">
                <x-slot:content>
                    @foreach($commercials as $index => $commercial)
                        <x-table.row>

                            <x-table.cell class="px-4 py-1 text-sm">
                                <div class="cursor-pointer w-10 h-10 overflow-hidden rounded-full hover:ring-2 ring-offset-1 hover:ring-gray-200 bg-gray-300">
                                    @if(isset($commercial['car']['mediable']['path']))
                                        <img
                                            class="w-full h-full object-cover"
                                            src="{{ \Illuminate\Support\Facades\Storage::url($commercial['car']['mediable']['path']) }}"
                                            alt="car" />
                                    @endif
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="max-w-[12rem] text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]">
                                    @if(isset($commercial['car']['model']))
                                        {{ $commercial['car']['model'] }}
                                    @endif
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                {{ to_currency($commercial['price']) }}
                            </x-table.cell>

                            <x-table.cell>
                                {{ $commercial['counter'] }}
                            </x-table.cell>

                            <x-table.cell>
                                {{ to_currency($commercial['cost']) }}
                            </x-table.cell>

                            <x-table.cell>

                                <span
                                    class="max-w-[12rem] text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]"
                                    title="{{ $commercial['description'] }}">
                                {{ $commercial['description'] }}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                {{ $commercial['location'] }}
                            </x-table.cell>

                            <x-table.cell>
                                @if($commercial['sold'])
                                    <span class="text-red-500">مُبَاعة</span>
                                @else
                                    <span class="text-greenify">متاحة</span>
                                @endif
                            </x-table.cell>

                            <x-table.controls-cell>
                                <!-- delete -->
                                <button
                                    wire:click.prevent="confirmingCommercialDeletion({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-red-400 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-red-100 hover:rounded-full"
                                    aria-label="Delete"
                                    title="حذف">
                                    <x-icons.remove />
                                </button>

                                <!-- edit -->
                                <a href="{{route('modify-commercials',  ['mode' => 'update', 'id' => $commercial['id'] ])}}">
                                    <button
                                        class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg focus:outline-none focus:shadow-outline-gray even:hover:bg-gray-200 hover:bg-gray-100 hover:rounded-full"
                                        title="تعديل"
                                        aria-label="Edit">
                                        <x-icons.edit-outline />
                                    </button>
                                </a>

                                <!-- hide/show message -->
                                <button
                                    wire:click="changeCommercialState({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-gray-400 rounded-lg focus:outline-none focus:shadow-outline-gray odd:hover:bg-gray-200 hover:bg-gray-100 hover:rounded-full"
                                    title="{{ $commercial['sold'] ? 'مُبَاع' : 'متاح' }}"
                                    aria-label="ToggleVisibility">

                                    @if($commercial['sold'])
                                        <x-icons.eye-off />
                                    @else
                                        <x-icons.eye />
                                    @endif
                                </button>

                            </x-table.controls-cell>
                        </x-table.row>
                    @endforeach
                </x-slot:content>
            </x-table.new>

            <!-- FAB -->
            <a href="{{route('modify-commercials',  ['mode' => 'create', 'id' => 'new'])}}">
                <button
                    class="group fixed right-4 bottom-4 md:right-8 md:bottom-8 cursor-pointer bg-red-500 text-sm focus:ring-4 focus:ring-red-200 shadow-xl shadow-red-200 hover:bg-red-600 active:bg-red-600 px-6 py-2 rounded-full text-red-200 hover:text-red-100"
                    type="button">
                    <div class="flex items-center gap-2">
                        <x-icons.pen />
                        <span class="text-red-200 group-hover:text-red-100 duration-300">
                        إضافة عرض
                    </span>
                    </div>
                </button>
            </a>
        </x-table.container>
    @endif

    @empty($commercial)
        <div class="md:py-20 py-2">
            <div class="p-2 flex items-center justify-center flex-col">
                <x-icons.no-commercials class="w-20 h-20" />
                <p class="py-4">لا يوجد أي عروض حالياً.</p>

                <a href="{{route('modify-commercials', ['mode' => 'create', 'id' => 'new'] )}}">
                    <button
                        class="group cursor-pointer bg-red-500 text-sm focus:ring-4 focus:ring-red-200 hover:bg-red-600 active:bg-red-600 px-6 py-2 rounded-full text-red-200 hover:text-red-100"
                        type="button">
                        <div class="flex items-center gap-2">
                            <x-icons.pen />
                            <span class="text-red-200 group-hover:text-red-100 duration-300">
                            إضافة عرض جديد
                        </span>
                        </div>
                    </button>
                </a>
            </div>
        </div>
    @endEmpty

    <!-- Delete Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingCommercialDeletion">
        <x-slot name="title">
            {{ __('حذف السيارة ') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل تريد حذف هذا العرض ؟') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button
                wire:click.prevent="$toggle('confirmingCommercialDeletion')"
                wire:loading.attr="disabled">
                {{ __('إلغاء') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="mr-3" wire:click="deleteCommercial" wire:loading.attr="disabled">
                {{ __('حذف') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>


</div>

