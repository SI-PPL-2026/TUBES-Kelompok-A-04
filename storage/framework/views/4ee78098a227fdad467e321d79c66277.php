<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['paginator']));

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

foreach (array_filter((['paginator']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($paginator->hasPages()): ?>
    <?php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        // Selalu tampil halaman 1, terakhir, dan tetangga halaman aktif; celah jadi "…"
        $keep = collect([1, $last, $current - 1, $current, $current + 1])->filter(fn ($p) => $p >= 1 && $p <= $last)->unique()->sort()->values();
    ?>

    <nav class="ui-pagination" aria-label="Halaman data">
        <p class="ui-pagination__range">
            Menampilkan <?php echo e($paginator->firstItem()); ?>–<?php echo e($paginator->lastItem()); ?> dari <?php echo e($paginator->total()); ?>

        </p>
        <div class="ui-pagination__pages">
            <a class="ui-pagination__btn" <?php if($paginator->onFirstPage()): ?> aria-disabled="true" <?php else: ?> href="<?php echo e($paginator->previousPageUrl()); ?>" <?php endif; ?> aria-label="Halaman sebelumnya">
                <img src="<?php echo e(asset('icons/arrow-right.svg')); ?>" alt="" width="14" height="14">
            </a>

            <?php $__currentLoopData = $keep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($i > 0 && $page - $keep[$i - 1] > 1): ?>
                    <span class="ui-pagination__gap" aria-hidden="true">…</span>
                <?php endif; ?>
                <a href="<?php echo e($paginator->url($page)); ?>"
                   class="ui-pagination__btn <?php echo e($page === $current ? 'ui-pagination__btn--active' : ''); ?>"
                   aria-label="Halaman <?php echo e($page); ?>" <?php if($page === $current): ?> aria-current="page" <?php endif; ?>><?php echo e($page); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <a class="ui-pagination__btn" <?php if(! $paginator->hasMorePages()): ?> aria-disabled="true" <?php else: ?> href="<?php echo e($paginator->nextPageUrl()); ?>" <?php endif; ?> aria-label="Halaman berikutnya">
                <img src="<?php echo e(asset('icons/arrow-right.svg')); ?>" alt="" width="14" height="14" class="ui-pagination__next">
            </a>
        </div>
    </nav>
<?php endif; ?><?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/components/ui/pagination.blade.php ENDPATH**/ ?>