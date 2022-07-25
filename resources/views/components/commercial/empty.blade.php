@props(['message' => 'لا توجد أي عروض حالياً'])

@php
    $classes = 'w-full absolute h-full flex justify-center items-center rounded-2xl';
    $messageClasses = 'text-center max-w-max font-bold text-2xl text-orange-500'
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <span class="{{ $messageClasses }}"> {{ $message }} </span>
</div>
