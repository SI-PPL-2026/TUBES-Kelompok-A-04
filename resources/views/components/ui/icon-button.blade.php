@props([
    'icon',
    'label',
    'href' => null,
    'frame' => false,
    'type' => 'button',
])

@php
    $classes = $frame ? 'ui-btn ui-btn--secondary ui-btn--icon' : 'ui-icon-btn';
@endphp

@if ($href)
    <a href="{{ $href }}" aria-label="{{ $label }}" title="{{ $label }}" {{ $attributes->merge(['class' => $classes]) }}>
        <img src="{{ asset('icons/' . $icon . '.svg') }}" alt="" width="20" height="20">
    </a>
@else
    <button type="{{ $type }}" aria-label="{{ $label }}" title="{{ $label }}" {{ $attributes->merge(['class' => $classes]) }}>
        <img src="{{ asset('icons/' . $icon . '.svg') }}" alt="" width="20" height="20">
    </button>
@endif
