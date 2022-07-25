<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لوحة التحكم') }}
        </h2>
    </x-slot>

    {{--    <div class="py-12">--}}
    {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
    {{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
    {{--                <div class="p-4">--}}
    {{--                    ....--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    --}}

    <div class="p-4">
        <div class="w-full h-screen box-border bg-white overflow-hidden rounded-xl relative">
            <div class="w-full max-h-[40rem] grid grid-cols-12 absolute inset-0 pb-4">
                <div class="sm:col-span-4 col-span-12 sm:border-l overflow-hidden relative">
                    <livewire:contact-us-control />
                </div>
                <div class="sm:col-span-8 col-span-12">
                    <div class="p-6">
                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
