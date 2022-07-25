@props(['collapsed' => false])

<x-collapsible :collapsed="$collapsed">
    <x-slot:title>
        الطريقة الثانية
    </x-slot:title>
    <x-slot:body>
        عروض البيع المباشر على السيارات التي تم شرؤها من قبلنا وعرضها مع كآفة التفاصيل والصور والفديو ،
        والسعر يكون شاملا واصلة السيارة للسعودية بطاقة جمركية بإسمك
    </x-slot:body>
</x-collapsible>
