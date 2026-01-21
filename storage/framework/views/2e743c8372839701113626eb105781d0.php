
<?php $__env->startSection('content'); ?>

<h2>Manage Stock</h2>

<form method="POST" action="/stock">
<?php echo csrf_field(); ?>
<input name="item_name" placeholder="Item Name" required>
<input name="quantity" type="number" placeholder="Quantity" required>
<input name="unit" placeholder="Unit">
<button class="btn">Add Stock</button>
</form>

<table>
<?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($s->item_name); ?></td>
    <td><?php echo e($s->quantity); ?></td>
    <td>
        <a href="/stock/<?php echo e($s->id); ?>/edit">Edit</a>
        <form method="POST" action="/stock/<?php echo e($s->id); ?>" style="display:inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/stock/index.blade.php ENDPATH**/ ?>