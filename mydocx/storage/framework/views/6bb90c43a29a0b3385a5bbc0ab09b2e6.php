<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Assign Farmer to Cooperative</h1>

        <form action="<?php echo e(route('cooperatives.assign')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="cooperative">Select Cooperative:</label>
                <select name="cooperative_id" id="cooperative" class="form-control">
                    <?php $__currentLoopData = $cooperatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cooperative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cooperative->id); ?>"><?php echo e($cooperative->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="farmer">Select Farmer:</label>
                <select name="farmer_id" id="farmer" class="form-control">
                    <?php $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($farmer->id); ?>"><?php echo e($farmer->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php elseif(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Assign</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\DCX\CODING\INTERNERSHIP\Laravel\Irrigation\Irrigation\resources\views/cooperatives/assign.blade.php ENDPATH**/ ?>