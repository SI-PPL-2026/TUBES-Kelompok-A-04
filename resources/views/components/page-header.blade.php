@props(['title'])

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <h1 class="text-[28px] sm:text-[30px] font-semibold leading-tight text-[#111111]">
        {{ $title }}
    </h1>

    @if ($slot->isNotEmpty())
        <div class="flex items-center gap-2 flex-wrap">
            {{ $slot }}
        </div>
    @endif
</div>