@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Thanks for your reservation on {{$order->sellable->name}}.
        @endcomponent
    @endslot
    {{-- Body --}}
    Service             {{$order->sellable->name}}

    Description         {{$order->sellable->description}}

    Price               {{$order->price}} CHF

    @foreach ($order->fields as $field){{$field->name}}         {{$field->value}}

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