<?php $__env->startSection('content'); ?>
    <h1>Cooperatives</h1>
    <a href="<?php echo e(route('cooperatives.create')); ?>">Add New Cooperative</a>
    <ul>
        <?php $__currentLoopData = $cooperatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cooperative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(route('cooperatives.show', $cooperative)); ?>"><?php echo e($cooperative->name); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\DCX\CODING\INTERNERSHIP\Laravel\Irrigation\Irrigation\resources\views/cooperatives/index.blade.php ENDPATH**/ ?>