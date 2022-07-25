@php
 $classes = 'md:w-1/6 md:h-1/6 w-20 h-20 mx-auto';
@endphp

<svg
    {{ $attributes->merge(['class' => $classes]) }}
    xmlns="http://www.w3.org/2000/svg" style="margin:auto;background:#fff;display:block;"
    width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
    <path
        d="M78,19H22c-6.6,0-12,5.4-12,12v31c0,6.6,5.4,12,12,12h37.2c0.4,3,1.8,5.6,3.7,7.6c2.4,2.5,5.1,4.1,9.1,4 c-1.4-2.1-2-7.2-2-10.3c0-0.4,0-0.8,0-1.3h8c6.6,0,12-5.4,12-12V31C90,24.4,84.6,19,78,19z"
        fill="#85a2b6"></path>
    <circle cx="30" cy="47" r="5" fill="#bbcedd">
        <animate attributeName="opacity" repeatCount="indefinite" dur="1s" keyTimes="0;0.2;1"
                 values="0;1;1"></animate>
    </circle>
    <circle cx="50" cy="47" r="5" fill="#dce4eb">
        <animate attributeName="opacity" repeatCount="indefinite" dur="1s" keyTimes="0;0.2;0.4;1"
                 values="0;0;1;1"></animate>
    </circle>
    <circle cx="70" cy="47" r="5" fill="#fdfdfd">
        <animate attributeName="opacity" repeatCount="indefinite" dur="1s" keyTimes="0;0.4;0.6;1"
                 values="0;0;1;1"></animate>
    </circle>
</svg>
