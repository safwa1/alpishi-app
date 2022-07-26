<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('إرتباطات الموقع') }}
        </h2>
    </x-slot>

    <div class="sm:py-12 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:shadow-xl shadow-md sm:rounded-lg">
                <livewire:links-data-table />
            </div>
        </div>
    </div>

</x-app-layout>
