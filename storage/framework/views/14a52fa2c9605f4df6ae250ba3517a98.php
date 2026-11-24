<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon',
    'label',
    'href' => null,
    'frame' => false,
    'type' => 'button',
]));

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

foreach (array_filter(([
    'icon',
    'label',
    'href' => null,
    'frame' => false,
    'type' => 'button',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $classes = $frame ? 'ui-btn ui-btn--secondary ui-btn--icon' : 'ui-icon-btn';
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" aria-label="<?php echo e($label); ?>" title="<?php echo e($label); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <img src="<?php echo e(asset('icons/' . $icon . '.svg')); ?>" alt="" width="20" height="20">
    </a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" aria-label="<?php echo e($label); ?>" title="<?php echo e($label); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <img src="<?php echo e(asset('icons/' . $icon . '.svg')); ?>" alt="" width="20" height="20">
    </button>
<?php endif; ?>
<?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/ui/icon-button.blade.php ENDPATH**/ ?>