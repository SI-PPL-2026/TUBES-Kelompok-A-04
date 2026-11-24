<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'placeholder' => 'Cari...',
    'name' => 'q',
    'action' => null,
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
    'placeholder' => 'Cari...',
    'name' => 'q',
    'action' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<form method="GET" action="<?php echo e($action ?? url()->current()); ?>" role="search">
    <?php $__currentLoopData = request()->except($name, 'page'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_scalar($val)): ?>
            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($val); ?>">
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <input
        type="search"
        name="<?php echo e($name); ?>"
        value="<?php echo e(request($name)); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        aria-label="<?php echo e($placeholder); ?>"
        <?php echo e($attributes->merge(['class' => 'ui-search'])); ?>

    >
</form>
<?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/ui/search.blade.php ENDPATH**/ ?>