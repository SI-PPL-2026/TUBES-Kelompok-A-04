@props([
    'variant' => 'secondary',
    'block' => false,
    'href' => null,
    'type' => 'button',
])

@php
    $classes = 'ui-btn ui-btn--' . $variant . ($block ? ' ui-btn--block' : '');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
