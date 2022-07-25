<div class="w-full h-full overflow-hidden relative">
    <div class="text-base text-primary px-6 py-4 border-b">
        رسائل العملاء
    </div>
    <div
        class="w-full h-full box-border h-full px-4 pt-4 pb-20 space-y-4 grid auto-rows-max grid-flow-row gap-1 overflow-y-auto scroll-smooth scrollbar-hide sm:scrollbar-default snap-y snap-mandatory scroll-py-4">

        @if(!empty($customersMessages))
            @foreach($customersMessages as $index => $message)
                <div class="rounded-md border overflow-hidden snap-start">

                    <div class="flex items-center gap-3 mx-3 px-4 py-2 mb-2 mt-4 rounded-lg bg-gray-100/80">
                    <span class="text-sm font-semibold">
                        المرسل
                        /
                    </span>
                        <span
                            class="text-sm text-neutral-500 font-semibold relative text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]">
                        {{ $message['name'] }}
                    </span>
                    </div>

                    <div class="flex items-center gap-3 mx-3 px-4 py-2 my-2 rounded-lg bg-gray-100/80">
                <span class="text-sm font-semibold">
                    البـريد
                    /
                </span>
                        <span
                            class="text-sm text-neutral-500 font-semibold relative text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]">
                    {{ $message['email'] }}
                </span>
                    </div>

                    <div
                        class="text-sm font-semibold px-6 pb-4 mt-4 relative text-ellipsis overflow-hidden [-webkit-line-clamp:1] [display:-webkit-box] [-webkit-box-orient:vertical]">
                        {{ $message['subject'] }}
                    </div>

                    <div class="text-sm text-neutral-500 m-1 px-5 pb-4 pt-1 overflow-y-auto max-h-[8rem]">
                        {{ $message['message'] }}
                    </div>

                    <div class="mt-8 flex justify-between items-center px-6 pb-4">
                        <div class="inline-flex gap-1">
                            <!-- delete -->
                            <button
                                wire:click.prevent="confirmingDelete({{$index}})"
                                class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-red-400 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-red-100 hover:rounded-full"
                                aria-label="Delete"
                                title="حذف">
                                <x-icons.remove />
                            </button>

                            <a href="mailto:{{ $message['email'] }}" target="_blank">
                                <button
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-green-500 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-green-100 hover:rounded-full"
                                    aria-label="Replay"
                                    title="رد عبر البريد">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </button>
                            </a>

                            @if(isset($message['phone']))
                                <a href="https://wa.me/{{$message['phone']}}">
                                    <button
                                        class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-[#128c7e] rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-[#cfe8e5] hover:rounded-full"
                                        aria-label="Copy"
                                        title="رد عبر واتساب">
                                        <x-icons.whatsapp />
                                    </button>
                                </a>

                                <button
                                    x-data="{ phone: {{$message['phone']}} }"
                                    @click="navigator.clipboard.writeText(phone)"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-blue-500 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-blue-100 hover:rounded-full"
                                    aria-label="Copy"
                                    title="نسخ رقم الهاتف">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </button>
                            @endif

                        </div>

                        <span class="text-xs text-primary font-semibold px-3 py-1 bg-primary/20 rounded-full">
                        {{ \Carbon\Carbon::parse($message['created_at'])->diffForHumans()}}
                    </span>
                    </div>
                </div>
            @endforeach
        @endif

        @if(empty($customersMessages))
            <div class="text-xs p-4 text-error">لا توجد رسائل</div>
        @endif

    </div>


    <!-- Delete Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingDelete">
        <x-slot name="title">
            {{ __('حذف السيارة ') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل تريد حذف هذه الرسالة ؟') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button
                wire:click.prevent="$toggle('confirmingDelete')"
                wire:loading.attr="disabled">
                {{ __('إلغاء') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="mr-3" wire:click="deleteMessage" wire:loading.attr="disabled">
                {{ __('حذف') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
