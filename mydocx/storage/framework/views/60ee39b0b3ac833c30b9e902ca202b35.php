<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Assignment Details</h1>

        <!-- Display Success Message if exists -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Check if there is any assignment data -->
        <?php if(!empty($details)): ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Farmer Name</th>
                        <th>Cooperative Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> {
                    <tr>
                        <td><?php echo e($data['member_name']); ?></td>
                        <td><?php echo e($data['cooperative_name']); ?></td>
                        <td><?php echo e($data['location']); ?></td>
                    </tr>}
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No assignment data available. Please assign a farmer to a cooperative first.</p>
        <?php endif; ?>

        <!-- Link to go back to the assignment form -->
        <a href="<?php echo e(route('cooperatives.showAssignForm')); ?>" class="btn btn-primary mt-4">Assign Another Farmer</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\DCX\CODING\INTERNERSHIP\Laravel\Irrigation\Irrigation\resources\views/cooperatives/assignment_details.blade.php ENDPATH**/ ?>