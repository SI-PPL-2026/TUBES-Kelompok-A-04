<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label',
    'name',
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'placeholder' => null,
    'prefill' => false,
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
    'label',
    'name',
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'placeholder' => null,
    'prefill' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $id = $attributes->get('id', $name);
    $error = $errors->first($name);
    $current = $type === 'password' && ! $prefill ? null : old($name, $value);
?>

<div class="ui-field">
    <label for="<?php echo e($id); ?>" class="ui-field__label"><?php echo e($label); ?></label>
    <input
        id="<?php echo e($id); ?>"
        name="<?php echo e($name); ?>"
        type="<?php echo e($type); ?>"
        value="<?php echo e($current); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php if($error): ?> aria-invalid="true" <?php endif; ?>
        <?php if($error || $hint): ?> aria-describedby="<?php echo e($id); ?>-msg" <?php endif; ?>
        <?php echo e($attributes->except('id')->merge(['class' => 'ui-control' . ($error ? ' ui-control--invalid' : '')])); ?>

    >
    <?php if($error): ?>
        <p id="<?php echo e($id); ?>-msg" class="ui-field__error" role="alert"><?php echo e($error); ?></p>
    <?php elseif($hint): ?>
        <p id="<?php echo e($id); ?>-msg" class="ui-field__hint"><?php echo e($hint); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/ui/input.blade.php ENDPATH**/ ?>