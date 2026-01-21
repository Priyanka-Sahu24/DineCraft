
<?php $__env->startSection('content'); ?>

<h2>Manage Categories</h2>

<form method="POST" action="/category">
<?php echo csrf_field(); ?>
<input type="text" name="name" placeholder="Category Name" required>
<button class="btn">Add Category</button>
</form>

<table>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($c->name); ?></td>
    <td>
        <a href="/category/<?php echo e($c->id); ?>/edit">Edit</a>
        <form method="POST" action="/category/<?php echo e($c->id); ?>" style="display:inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/category/index.blade.php ENDPATH**/ ?>