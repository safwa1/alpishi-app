<x-jet-dialog-modal wire:model="managingMessages">
    <x-slot name="title">
       {{$slot}}
    </x-slot>

    <x-slot name="content">
        <div>
            {{--x-data="{ model: @entangle('messageModel')}--}}
            <form method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700"> نص التنبيه </label>
                    <div class="mt-1">
                        <textarea
                            wire:model="messageModel.message"
                            id="message"
                            rows="3"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="تهنئه، تحذير أو معلومة...إلخ."></textarea>
                    </div>
                    @if($errors->has("messageModel.message"))
                        <span class="text-error text-xs">لا يمكن ترك هذا الحقل فارغاً.</span>
                        {{--<span class="text-error text-xs">{{ $errors->first("links.{$index}.data") }}</span>--}}
                    @endif
                </div>

                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="messageType" class="block text-sm font-medium text-gray-700">نوع
                            التنبيه</label>
                        <select dir="ltr" wire:model="messageModel.type" id="messageType" name="messageType"
                                autocomplete="message-type"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="info">إفتراضي</option>
                            <option value="warning">تحذير</option>
                            <option value="error">خطأ</option>
                            <option value="success">نجاح</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="messageState" class="block text-sm font-medium text-gray-700">حالة
                            التنبيه</label>
                        <select wire:model="messageModel.state" dir="ltr" id="messageState" name="messageState"
                                autocomplete="message-state"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="on">يعمل</option>
                            <option value="off">متوقف</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="show_at" class="block text-sm font-medium text-gray-700">موعد العرض</label>
                        <input
                            wire:model="messageModel.show_at"
                            type="date"
                            id="show_at"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="expires_at" class="block text-sm font-medium text-gray-700">تاريخ الإنتهاء</label>
                        <input
                            wire:model="messageModel.expires_at"
                            type="date"
                            id="expires_at"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

            </form>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('managingMessages', false)" wire:loading.attr="disabled">
            {{ __('إلغاء') }}
        </x-jet-secondary-button>

        <x-jet-button class="mr-3" wire:click="saveMessage" wire:loading.attr="disabled">
            {{ __('حفظ') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
