@if(!empty($messages))
    @foreach($messages as $message)
        @if($message['state'] == 'on')
            <x-bladewind.alert
                shade="dark"
                :type="$message['type']">
                {{ $message['message'] }}
            </x-bladewind.alert>
        @endif
    @endforeach
@endif

