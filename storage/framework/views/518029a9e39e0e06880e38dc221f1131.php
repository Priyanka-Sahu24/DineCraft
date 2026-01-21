
<?php $__env->startSection('content'); ?>

<h2>Edit Menu</h2>

<form method="POST" action="/menu/<?php echo e($menu->id); ?>">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<input name="name" value="<?php echo e($menu->name); ?>">
<input name="price" value="<?php echo e($menu->price); ?>">
<button class="btn">Update</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/menu/edit.blade.php ENDPATH**/ ?>