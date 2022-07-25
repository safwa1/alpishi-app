<div {{$attributes->class(['hidden w-full h-[44px] justify-center items-center bg-brand']) }}>
    <div class="flex items-center justify-center gap-10 overflow-hidden h-full">
        <x-menu.desktop.menu-item
            href="{{ route('home') }}"
            :active="request()->routeIs('home')">
            الرئيسية
        </x-menu.desktop.menu-item>

        <x-menu.desktop.menu-item
            href="{{ route('about') }}"
            :active="request()->routeIs('about')">
            من نحن
        </x-menu.desktop.menu-item>

        <x-menu.desktop.menu-item
            href="{{ route('purchase-methods') }}"
            :active="request()->routeIs('purchase-methods')">
            آلية شراء السيارات
        </x-menu.desktop.menu-item>

        <x-menu.desktop.menu-item
            href="{{ route('contactus') }}"
            :active="request()->routeIs('contactus')">
            إتصل بنا
        </x-menu.desktop.menu-item>

        <x-menu.desktop.menu-item
            href="{{ route('auction') }}"
            :active="request()->routeIs('auction')">
            المزادات اليومية
        </x-menu.desktop.menu-item>

    </div>
</div>
