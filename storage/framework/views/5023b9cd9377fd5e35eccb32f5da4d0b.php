
<?php $__env->startSection('content'); ?>

<h2>Edit Category</h2>

<form method="POST" action="/category/<?php echo e($category->id); ?>">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<input type="text" name="name" value="<?php echo e($category->name); ?>">
<button class="btn">Update</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/admin/category/edit.blade.php ENDPATH**/ ?>