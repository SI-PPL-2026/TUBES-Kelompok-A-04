@props([
    'label',
    'edit' => null,
    'editModal' => null,
    'deleteModal' => null,
])

<div {{ $attributes->merge(['class' => 'ui-row-actions']) }}>
    @if ($editModal)
        <x-ui.icon-button icon="pencil-simple" :label="'Ubah ' . $label"
            x-data x-on:click.stop="$dispatch('open-modal', '{{ $editModal }}')" />
    @elseif ($edit)
        <x-ui.icon-button icon="pencil-simple" :label="'Ubah ' . $label" :href="$edit" />
    @endif
    @if ($deleteModal)
        <x-ui.icon-button icon="trash" :label="'Hapus ' . $label"
            x-data x-on:click.stop="$dispatch('open-modal', '{{ $deleteModal }}')" />
    @endif
</div>
