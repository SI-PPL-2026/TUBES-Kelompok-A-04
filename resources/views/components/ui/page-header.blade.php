@props(['title'])

<div {{ $attributes->merge(['class' => 'ui-page-header']) }}>
    <h1 class="t-30-semibold">{{ $title }}</h1>
    @if ($slot->isNotEmpty())
        <div class="ui-actions">{{ $slot }}</div>
    @endif
</div>
