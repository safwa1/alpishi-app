@props(['links'])

<div>
    {{--Socail Icons--}}
    <x-socail-links.show :links="$links" />

    {{--Site Copyright--}}
    <x-copyright-section />
</div>
