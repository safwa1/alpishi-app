@props(['id' => null, 'maxWidth' => null, 'cancelable' => true])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }} :cancelable="$cancelable">
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
