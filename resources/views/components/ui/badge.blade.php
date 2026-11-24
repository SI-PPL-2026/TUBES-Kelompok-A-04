@props(['tone' => 'brand'])

<span {{ $attributes->merge(['class' => 'ui-badge ui-badge--' . $tone]) }}>{{ $slot }}</span>