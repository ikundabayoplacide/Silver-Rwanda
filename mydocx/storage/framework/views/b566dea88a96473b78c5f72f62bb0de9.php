<?php $__env->startSection('content'); ?>
    <h1>Add Cooperative</h1>
    <form action="<?php echo e(route('cooperatives.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required></br>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required></br>
        <label for="services_offered">Services Offered:</label>
        <input type="text" name="services_offered" id="services_offered" required></br>

        
    </br>
    <button type="submit">Add Cooperative</button>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\DCX\CODING\INTERNERSHIP\Laravel\Irrigation\Irrigation\resources\views/cooperatives/create.blade.php ENDPATH**/ ?>