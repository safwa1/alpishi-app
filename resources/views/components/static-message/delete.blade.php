<x-jet-confirmation-modal wire:model="confirmingMessageDeletion">
    <x-slot name="title">
        {{ __('حذف التنبيه ') }}
    </x-slot>

    <x-slot name="content">
        {{ __('هل أنت متأكد أنك تريد حذف هذا التنبيه ؟') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click.prevent="$toggle('confirmingMessageDeletion')"
                                wire:loading.attr="disabled">
            {{ __('إلغاء') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="mr-3" wire:click="deleteMessage" wire:loading.attr="disabled">
            {{ __('حذف') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
