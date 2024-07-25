

<form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
<?php /**PATH P:\DCX\CODING\INTERNERSHIP\Laravel\Irrigation\Irrigation\resources\views/auth/login.blade.php ENDPATH**/ ?>