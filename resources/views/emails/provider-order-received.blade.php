@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{$order->client->name}} has reserved {{$order->sellable->name}}.
        @endcomponent
    @endslot
    {{-- Body --}}
    Client              {{$order->client->name}}

    E-mail              {{$order->client->email}}

    Address             {{$order->client->street}}
                        {{$order->client->npa}} {{$order->client->town}}
                        {{$order->client->country}}

    @foreach ($order->fields as $field){{$field->name}}     {{$field->value}}

    @endforeach

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
        @endcomponent
    @endslot
@endcomponent