@php
    //'message', 'type', 'state', 'show_at', 'expires_at'
        $columnHeaders = [
            'المعرف',
            'نص التنبيه',
            'النوع',
            'الحالة',
            'موعد العرض',
            'تاريخ الإنتهاء',
        ];
@endphp

<div>
    @if(!empty($messages))
        <x-table.container>
            <x-table.new :column-headers="$columnHeaders">
                <x-slot:content>
                    @foreach($messages as $index => $message)
                        <x-table.row>

                            <x-table.cell>
                                {{ $message['id'] }}#
                            </x-table.cell>

                            <x-table.cell>
                                <span
                                    class="max-w-[20rem] text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]"
                                    title="{{ $message['message'] }}">
                                    {{ $message['message'] }}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex items-center">
                                    <x-tag :type="$message['type']" />
                                    {{ \App\Utils\Translator::toArabic($message['type']) }}
                                </div>
                            </x-table.cell>

                            @if($message['state'] == 'on')
                                <x-table.cell class="text-greenify opacity-75">
                                    {{ \App\Utils\Translator::toArabic($message['state']) }}
                                </x-table.cell>
                            @else
                                <x-table.cell class="text-red-500 opacity-75">
                                    {{ \App\Utils\Translator::toArabic($message['state']) }}
                                </x-table.cell>
                            @endif

                            <x-table.cell>
                                {{ $message['show_at'] }}
                            </x-table.cell>

                            <x-table.cell>
                                {{ $message['expires_at'] }}
                            </x-table.cell>

                            <x-table.controls-cell>
                                <!-- delete -->
                                <button
                                    wire:click.prevent="confirmingMessageDeletion({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-red-400 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-red-100 hover:rounded-full"
                                    aria-label="Delete"
                                    title="حذف">
                                    <x-icons.remove />
                                </button>

                                <!-- edit -->
                                <button
                                    wire:click="managingMessages({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg focus:outline-none focus:shadow-outline-gray even:hover:bg-gray-200 hover:bg-gray-100 hover:rounded-full"
                                    title="تعديل"
                                    aria-label="Edit">
                                    <x-icons.edit-outline />
                                </button>

                                <!-- hide/show message -->
                                <button
                                    wire:click="changeMessageState({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-gray-400 rounded-lg focus:outline-none focus:shadow-outline-gray odd:hover:bg-gray-200 hover:bg-gray-100 hover:rounded-full"
                                    title="{{ $message['state'] == 'on' ? 'تعطيل' : 'تمكين' }}"
                                    aria-label="ToggleVisibility">

                                    @if($message['state'] == "on")
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
            <button wire:click="managingMessages"
                    class="group fixed right-4 bottom-4 md:right-8 md:bottom-8 cursor-pointer bg-red-500 text-sm focus:ring-4 focus:ring-red-200 shadow-xl shadow-red-200 hover:bg-red-600 active:bg-red-600 px-6 py-2 rounded-full text-red-200 hover:text-red-100"
                    type="button">
                <div class="flex items-center gap-2">
                    <x-icons.pen />
                    <span class="hidden text-red-200 group-hover:inline-flex group-hover:text-red-100 duration-300">إضافة تنبيه</span>
                </div>
            </button>

        </x-table.container>
    @endif

    @empty($messages)
        <div class="md:py-20 py-2">
            <div class="p-2 flex items-center justify-center flex-col">
                <x-icons.no-notify class="w-20 h-20" />
                <p class="py-4">لا يوجد أي تنبيهات حالياً.</p>
                <button
                    wire:click="managingMessages"
                    class="group cursor-pointer bg-red-500 text-sm focus:ring-4 focus:ring-red-200 hover:bg-red-600 active:bg-red-600 px-6 py-2 rounded-full text-red-200 hover:text-red-100"
                    type="button">
                    <div class="flex items-center gap-2">
                        <x-icons.pen />
                        <span class="text-red-200 group-hover:text-red-100 duration-300">إضافة تنبيه جديد</span>
                    </div>
                </button>
            </div>
        </div>
    @endEmpty

    <!-- Delete Confirmation Modal -->
    <x-static-message.delete />

    <!-- Create New Messages Modal -->
    <x-static-message.manage>
        {{ __(':title', ['title' => is_null($messageIndexBeingUpdated) ? 'تنبيه جديد': 'تعديل التنبيه']) }}
    </x-static-message.manage>

</div>
