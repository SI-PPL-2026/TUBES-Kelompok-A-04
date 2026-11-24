<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'secondary', // primary | secondary | danger
    'block' => false,         // true untuk lebar penuh (misal di dalam modal)
    'href' => null,
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
    'variant' => 'secondary', // primary | secondary | danger
    'block' => false,         // true untuk lebar penuh (misal di dalam modal)
    'href' => null,
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
    $baseClasses = 'inline-flex items-center justify-center gap-2 h-[38px] px-5 rounded-full text-[13px] font-semibold leading-normal whitespace-nowrap border transition-all cursor-pointer disabled:cursor-not-allowed';

    $variants = [
        'primary'   => 'bg-[#2F318B] text-white border-transparent hover:brightness-110 disabled:bg-[#BABBE8] disabled:hover:brightness-100',
        'secondary' => 'bg-white text-[#111111] border-[#EEEEEE] hover:bg-[#F8F8F8] disabled:opacity-50',
        'danger'    => 'bg-[#DE0000] text-white border-transparent hover:brightness-110 disabled:opacity-50',
    ];

    $widthClass = $block ? 'w-full flex-1' : '';
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['secondary']) . ' ' . $widthClass;
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?><?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/button.blade.php ENDPATH**/ ?>