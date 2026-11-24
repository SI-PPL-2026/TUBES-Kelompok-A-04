<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'icon' => 'book-bookmark',
    'tone' => 'brand',
    'title',
    'description' => null,
    'action' => null,
    'method' => 'POST',
    'show' => false,
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
    'name',
    'icon' => 'book-bookmark',
    'tone' => 'brand',
    'title',
    'description' => null,
    'action' => null,
    'method' => 'POST',
    'show' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-data="{ open: <?php echo \Illuminate\Support\Js::from($show)->toHtml() ?> }"
     x-on:open-modal.window="if ($event.detail === '<?php echo e($name); ?>') open = true"
     x-on:close-modal.window="if ($event.detail === '<?php echo e($name); ?>') open = false"
     x-on:keydown.escape.window="open = false">
    <div class="ui-modal" x-show="open" x-cloak x-transition.opacity x-on:mousedown.self="open = false">
        <div class="ui-modal__panel" role="dialog" aria-modal="true" aria-labelledby="<?php echo e($name); ?>-title"
             x-trap.noscroll="open">
            <?php if($action): ?>
                <form method="POST" action="<?php echo e($action); ?>" class="ui-modal__form" novalidate>
                    <?php echo csrf_field(); ?>
                    <?php if (! (strtoupper($method) === 'POST')): ?>
                        <?php echo method_field($method); ?>
                    <?php endif; ?>
            <?php endif; ?>

            <div class="ui-modal__head">
                <span class="ui-modal__icon <?php echo e($tone === 'red' ? 'ui-modal__icon--red' : ''); ?>">
                    <img src="<?php echo e(asset('icons/' . $icon . '.svg')); ?>" alt="" width="20" height="20">
                </span>
                <div class="ui-modal__text">
                    <h2 id="<?php echo e($name); ?>-title" class="t-16-semibold"><?php echo e($title); ?></h2>
                    <?php if($description): ?>
                        
                        <p class="t-12-regular text-gray">
                            <?php echo collect(preg_split('/\R/', e($description)))->map(fn ($baris) => trim($baris))->join('<br>'); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <?php echo e($slot); ?>


            <?php if(isset($footer)): ?>
                <div class="ui-modal__footer"><?php echo e($footer); ?></div>
            <?php endif; ?>

            <?php if($action): ?>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/ui/modal.blade.php ENDPATH**/ ?>