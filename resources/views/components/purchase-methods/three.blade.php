@props(['collapsed' => false])

<x-collapsible :collapsed="$collapsed">
    <x-slot:title>
        الطريقة الثالثة
    </x-slot:title>
    <x-slot:body>
        البحث عن سيارات معينة من المعارض الكورية بحسب رغبة العميل
    </x-slot:body>
</x-collapsible>
