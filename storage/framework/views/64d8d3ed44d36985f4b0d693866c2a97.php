<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <h1 class="text-[28px] sm:text-[30px] font-semibold leading-tight text-[#111111]">
        <?php echo e($title); ?>

    </h1>

    <?php if($slot->isNotEmpty()): ?>
        <div class="flex items-center gap-2 flex-wrap">
            <?php echo e($slot); ?>

        </div>
    <?php endif; ?>
</div><?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/page-header.blade.php ENDPATH**/ ?>