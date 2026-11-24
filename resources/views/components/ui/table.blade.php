@props(['caption' => null, 'paginator' => null, 'minWidth' => null])

<div {{ $attributes->merge(['class' => 'ui-table-card']) }}>
    <div class="ui-table-scroll">
        <table class="ui-table" @if ($minWidth) style="min-width: {{ $minWidth }}px" @endif>
            @if ($caption)
                <caption class="sr-only">{{ $caption }}</caption>
            @endif
            <thead>
                <tr>{{ $head }}</tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if ($paginator)
        <x-ui.pagination :paginator="$paginator" />
    @endif
</div>