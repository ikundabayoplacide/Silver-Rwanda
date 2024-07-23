



<form method="POST" action="<?php echo e(route('register')); ?>">
    <?php echo csrf_field(); ?>
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Register</button>
</form>
<?php /**PATH P:\DCX\CODING\INTERNERSHIP\Laravel\Irrigation\Irrigation\resources\views/auth/register.blade.php ENDPATH**/ ?>