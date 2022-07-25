@props(['text'])

@php
    $classes = 'p-2 md:text-lg text-xs font-medium text-center opacity-90 leading-5';
    $content = $text ?? __(' :part_one <br> :part_two <br> :part_three', [
        'part_one' => 'نخدمك طيلة أيام الاسبوع خلال اوقات العمل التالية',
         'part_two' => 'من السبت حتى الخميس من الساعة ٩ صباحاً حتى ١١ مساءً',
          'part_three' => 'الجمعة من ١ ظهراً الى ١١ مساءً'
          ]);
@endphp

<div {{$attributes->merge(['class' => $classes])}}>
    {!! $content !!}
</div>
