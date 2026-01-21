
<?php $__env->startSection('content'); ?>

<h2>Manage Menu</h2>

<form method="POST" action="/menu">
<?php echo csrf_field(); ?>
<input name="name" placeholder="Menu Name" required>

<select name="category_id">
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<select name="stock_id">
<?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($s->id); ?>"><?php echo e($s->item_name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<input name="stock_used" type="number" placeholder="Stock Used" required>
<input name="price" type="number" placeholder="Price" required>

<button class="btn">Add Menu</button>
</form>

<table>
<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($m->name); ?></td>
    <td><?php echo e($m->category->name); ?></td>
    <td><?php echo e($m->price); ?></td>
    <td>
        <a href="/menu/<?php echo e($m->id); ?>/edit">Edit</a>
        <form method="POST" action="/menu/<?php echo e($m->id); ?>" style="display:inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/menu/index.blade.php ENDPATH**/ ?>