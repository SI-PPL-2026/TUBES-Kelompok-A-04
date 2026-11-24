<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'Perpustakaan SMP IT'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <?php if($polos): ?>
        <?php echo e($slot); ?>

    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginalea3ff48ecc2c47bd6007ee32944844eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea3ff48ecc2c47bd6007ee32944844eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.header','data' => ['nav' => $nav]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nav' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($nav)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalea3ff48ecc2c47bd6007ee32944844eb)): ?>
<?php $attributes = $__attributesOriginalea3ff48ecc2c47bd6007ee32944844eb; ?>
<?php unset($__attributesOriginalea3ff48ecc2c47bd6007ee32944844eb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea3ff48ecc2c47bd6007ee32944844eb)): ?>
<?php $component = $__componentOriginalea3ff48ecc2c47bd6007ee32944844eb; ?>
<?php unset($__componentOriginalea3ff48ecc2c47bd6007ee32944844eb); ?>
<?php endif; ?>

        <div class="ui-main-margin">
            <main class="ui-main">
                <?php echo e($slot); ?>

            </main>
        </div>
    <?php endif; ?>
</body>
</html>
<?php /**PATH D:\College\SEM 5\PPL\Tubes\TUBES-Kelompok-A-04\resources\views/layouts/app.blade.php ENDPATH**/ ?>