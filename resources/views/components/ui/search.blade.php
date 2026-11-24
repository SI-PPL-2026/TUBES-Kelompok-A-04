@props([
    'placeholder' => 'Cari...',
    'name' => 'q',
    'action' => null,
])

<form method="GET" action="{{ $action ?? url()->current() }}" role="search">
    @foreach (request()->except($name, 'page') as $key => $val)
        @if (is_scalar($val))
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endif
    @endforeach
    <input
        type="search"
        name="{{ $name }}"
        value="{{ request($name) }}"
        placeholder="{{ $placeholder }}"
        aria-label="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'ui-search']) }}
    >
</form>