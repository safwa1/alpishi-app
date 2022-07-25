<x-jet-confirmation-modal wire:model="confirmingCarDeletion">
    <x-slot name="title">
        {{ __('حذف السيارة ') }}
    </x-slot>

    <x-slot name="content">
        {{ __('هل أنت متأكد أنك تريد حذف هذه السيارة ؟') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click.prevent="$toggle('confirmingCarDeletion')"
                                wire:loading.attr="disabled">
            {{ __('إلغاء') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="mr-3" wire:click="deleteCar" wire:loading.attr="disabled">
            {{ __('حذف') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
