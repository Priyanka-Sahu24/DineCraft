
<?php $__env->startSection('content'); ?>

<h2>Edit Stock</h2>

<form method="POST" action="/stock/<?php echo e($stock->id); ?>">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<input name="item_name" value="<?php echo e($stock->item_name); ?>">
<input name="quantity" type="number" value="<?php echo e($stock->quantity); ?>">
<input name="unit" value="<?php echo e($stock->unit); ?>">
<button class="btn">Update</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/stock/edit.blade.php ENDPATH**/ ?>