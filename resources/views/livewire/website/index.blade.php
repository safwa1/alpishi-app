<div>
    {{-- slider --}}
    <livewire:slider />

    <!-- latest cars -->
    <x-commercial.latest :commercials="$latestCommercials" />

    <!-- purchase methods -->
    <x-purchase-methods.show />

    <!-- inquiries, ask-us -->
    <x-inquiries.show :phone-number="$phoneNumber"/>

</div>
