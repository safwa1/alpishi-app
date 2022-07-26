<div
    class="overflow-hidden w-full m-auto bg-white py-2">
    <div class="overflow-x-auto w-full sm:scrollbar-default scrollbar-hide scroll-smooth">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr
                class="text-sm font-semibold tracking-wide text-right text-gray-600 border-b">
                <th class="px-4 py-3"></th>
                <th class="px-4 py-3">المعرف</th>
                <th class="px-4 py-3">الاسم</th>
                <th class="px-4 py-3">البيانات</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y">
            @foreach($links as $index => $link)

                <tr class="text-gray-500/80 even:bg-gray-100">
                    <td class="px-4 py-1 text-sm">
                        <x-dashboard.links.row-icon :name="$link['name']" />
                    </td>
                    <td class="px-4 py-1 text-sm font-semibold">
                        {{ $link['id'] }}
                    </td>
                    <td class="px-4 py-1 text-sm font-semibold">
                        {{ \App\Utils\LinksTranslator::toArabic($link['name']) }}
                    </td>

                    @if(!is_null($linkIndexBeingUpdated) && $index == $linkIndexBeingUpdated)
                        <td class="px-2 py-1.5 text-sm font-semibold cursor-pointer hover:text-blue-600 hover:underline text-right">
                            <x-jet-input @keyup.enter.prevent="$wire.saveLinkData({{$index}})" id="name" type="text" class="block w-full" wire:model.defer="links.{{$index}}.data" dir="ltr" autofocus />

                            @if($errors->has("links.{$index}.data"))
                                <span class="text-error text-xs">لا يمكن ترك هذا الحقل فارغاً.</span>
{{--                                <span class="text-error text-xs">{{ $errors->first("links.{$index}.data") }}</span>--}}
                            @endif
                        </td>
                    @else
                        <td class="px-4 py-3 text-sm font-semibold cursor-pointer text-right" dir="ltr">
                            {{ $link['data'] }}
                        </td>
                    @endif

                    <td class="px-4 py-1">
                        <div class="flex items-center gap-2 text-sm">
                            @if(!is_null($linkIndexBeingUpdated) && $index == $linkIndexBeingUpdated)
                                <x-jet-danger-button wire:click="cancelEdit" wire:loading.attr="disabled">
                                    {{ __('إلغاء') }}
                                </x-jet-danger-button>

                                <x-jet-secondary-button wire:click="saveLink({{$index}})" wire:loading.attr="disabled">
                                    {{ __('حفظ') }}
                                </x-jet-secondary-button>
                            @else
                                <!-- delete -->
                                <button
                                    wire:click="confirmingLinkDeletion({{ $index }})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-red-400 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-red-100 hover:rounded-full"
                                    aria-label="Delete"
                                    title="حذف">
                                    <x-icons.remove />
                                </button>

                                <!-- edit -->
                                <button
                                    wire:click="editable({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg focus:outline-none focus:shadow-outline-gray even:hover:bg-gray-200 hover:bg-gray-100 hover:rounded-full"
                                    title="تعديل"
                                    aria-label="Edit">
                                    <x-icons.edit-outline />
                                </button>
                            @endif
                        </div>
                    </td> <!-- actions -->
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>


    <!-- Delete Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingLinkDeletion">
        <x-slot name="title">
            {{ __('حذف الرابط ') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل أنت متأكد أنك تريد حذف هذا الرابط؟') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingLinkDeletion')" wire:loading.attr="disabled">
                {{ __('إلغاء') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="mr-3" wire:click="deleteLink" wire:loading.attr="disabled">
                {{ __('حذف') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</div>
