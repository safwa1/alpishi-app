<div x-data="{open: false}"
     class="relative">
    <div {{$attributes->class(['w-full h-[50px] border-b border-gary-100/90 overflow-hidden']) }}>
        <div class="w-full h-full flex items-center gap-6 px-6">
            <div
                class="menu-button text-neutral-500 p-1.5 rounded-lg bg-gray-100/80">
                <svg
                    x-data="{
                    closed: 'M4 6h16M4 12h8m-8 6h16',//'M6 18L18 6M6 6l12 12',
                    opened: 'M4 6h16M4 12h16m-7 6h7'
                    }"
                    @click="open = !open"
                    aria-haspopup="true"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="open ? closed : opened" />
                </svg>
            </div>
            <div class="title text-sm text-[#0F6BA5]">
                @if( request()->routeIs('home') )
                    {{ __("الرئيسية") }}
                @endif
                @if( request()->routeIs('purchase-methods') )
                    {{ __("آلية شراء السيارات") }}
                @endif
                @if( request()->routeIs('about') )
                    {{ __("من نحن") }}
                @endif
                @if( request()->routeIs('contactus') )
                    {{ __("إتصل بنا") }}
                @endif
            </div>
        </div>
    </div>
    <div
         x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-in-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-y-0 -translate-y-1/2"
         x-transition:enter-end="opacity-100 transform scale-y-100 translate-y-0"
         x-transition:leave="transition ease-in-out duration-300"
         x-transition:leave-start="opacity-100 transform scale-y-100 translate-y-0"
         x-transition:leave-end="opacity-0 transform scale-y-0 -translate-y-1/2"
         class="absolute inset-x-0 left-0 bg-white z-50 md:hidden flex-col shadow-lg">
        <x-menu.mobile.menu-item @click="open = false" href="{{route('home')}}" :active="request()->routeIs('home')" :is-last="false">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </x-slot>
            <x-slot name="title">
                الرئيسية
            </x-slot>
        </x-menu.mobile.menu-item>

        <x-menu.mobile.menu-item @click="open = false" href="{{route('about')}}" :active="request()->routeIs('about')" :is-last="false">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot>
            <x-slot name="title">
                من نحن
            </x-slot>
        </x-menu.mobile.menu-item>

        <x-menu.mobile.menu-item @click="open = false" href="{{route('purchase-methods')}}" :active="request()->routeIs('purchase-methods')" :is-last="false">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
            </x-slot>
            <x-slot name="title">
                آلية شراء السيارات
            </x-slot>
        </x-menu.mobile.menu-item>

        <x-menu.mobile.menu-item @click="open = false" href="{{route('contactus')}}" :active="request()->routeIs('contactus')" :is-last="false">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </x-slot>
            <x-slot name="title">
                إتصل بنا
            </x-slot>
        </x-menu.mobile.menu-item>

        <x-menu.mobile.menu-item @click="open = false" href="{{route('auction')}}" :active="request()->routeIs('auction')" :is-last="true">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </x-slot>
            <x-slot name="title">
                المزادات اليومية
            </x-slot>
        </x-menu.mobile.menu-item>
    </div>
</div>
